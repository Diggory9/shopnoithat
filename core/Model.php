<?php
namespace app\core;
abstract class Model
{
    public const RULE_REQUIRED ='required';
    public const RULE_EMAIL ='email';
    public const RULE_MIN ='min';
    public const RULE_MAX ='max';
    public const RULE_MACTH ='macth';
    public const RULE_UNIQUE ='unique';



    public function loadData($data)
    {
     
        foreach($data as $key =>$value)
        {   
            if(property_exists($this, $key))
            {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules();


    public array $errors =[];

    public function validate()
    {
        
        foreach($this->rules() as $attribute => $rules)
        {
            $value = $this->{$attribute};
            foreach($rules as $rule)
            {
                $ruleName = $rule;
                if(!is_string($ruleName))
                {
                    $ruleName = $rule[0];

                }
                if($ruleName === self::RULE_REQUIRED && !$value)
                {
                    $this->addErrorsForRule($attribute, self::RULE_REQUIRED);
                }
                if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL))
                {
                    $this->addErrorsForRule($attribute, self::RULE_EMAIL);
                }
                if($ruleName === self::RULE_MIN && strlen($value)< $rule['min'] )
                {
                    $this->addErrorsForRule($attribute, self::RULE_MIN,$rule);
                }
                if($ruleName === self::RULE_MAX && strlen($value)> $rule['max'] )
                {
                    $this->addErrorsForRule($attribute, self::RULE_MAX, $rule);
                }
                 if($ruleName === self::RULE_MACTH && $value !== $this->{$rule['match']} )
                {
                    $this->addErrorsForRule($attribute, self::RULE_MACTH,$rule); 
                }
                if($ruleName === self::RULE_UNIQUE)
                {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute']??$attribute;
                    $tableName = $className::tableName();
                    $stmt =  Application::$app->db->getConnection()->prepare("SELECT * FROM $tableName WHERE $uniqueAttr =:$uniqueAttr");
                    $stmt->bindValue(":$uniqueAttr", $value);
                    $stmt->execute();
                    $record = $stmt->fetchObject();
                    if($record)
                    {
                        $this->addErrorsForRule($attribute,self::RULE_UNIQUE,['field'=>$value]);
                    }
                }
            }
          
        }
       
        return empty($this->errors);
    }
    private function addErrorsForRule(string $attribute, string $rule,$params =[]){
        $message = $this->errorMessages()[$rule]??"";
        foreach($params as $key => $value)
        {
            $message = str_replace("{{$key}}",$value,$message);
        }
        $this->errors[$attribute][] =$message;
    }

    public function addErrors(string $attribute, string $message)
    {
        $this->errors[$attribute][] =$message;
    }
    public function errorMessages()
    {
        return [
        self::RULE_REQUIRED => 'This field is required',
        self::RULE_EMAIL =>'This field must be valid email address',
        self::RULE_MIN =>'Min lenght of this field must be {min}',
        self::RULE_MAX =>'Max lenght of this field must be {max}',
        self::RULE_MACTH =>'This filed must be the same as {match}',
        self::RULE_UNIQUE =>'Record with this email {field} already exists',
        ];
        
    }

    public  function hasError($attribute)
    {
        return $this->errors[$attribute]?? false;
    }

    public function getFirstError($attribute) {
        return $this->errors[$attribute][0]??false;
    }
}
