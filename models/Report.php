<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Model;
use Exception;
use PDO;

class Report
{
    public function get12MonthRepor()
    {
        try
        {
            $sql = "SELECT
            LPAD(m.month, 2, '0') AS month,
            COALESCE(COUNT(o.order_id), 0) AS order_count
        FROM (
            SELECT 1 AS month
            UNION SELECT 2
            UNION SELECT 3
            UNION SELECT 4
            UNION SELECT 5
            UNION SELECT 6
            UNION SELECT 7
            UNION SELECT 8
            UNION SELECT 9
            UNION SELECT 10
            UNION SELECT 11
            UNION SELECT 12
        ) AS m
        LEFT JOIN user_order o ON MONTH(o.order_date) = m.month AND YEAR(o.order_date) = YEAR(CURRENT_DATE())
        GROUP BY YEAR(CURRENT_DATE()), m.month";
            $stmt = Application::$app->db->getConnection()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e)
        {
            return null;
        }

    }
}