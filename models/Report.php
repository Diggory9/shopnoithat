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
    public function getTop3ProductSell()
    {
        try
        {
            $sql = "SELECT
            p.product_id,
            p.product_name,
            p.product_price,
            SUM(o.total_amount) AS total_sales,
                    pi.image_path
                FROM
                    user_order o
                JOIN
                    product p ON o.order_id = p.product_id
                JOIN
                    product_image pi ON p.product_id = pi.product_id
                GROUP BY
                    p.product_id
                ORDER BY
                    total_sales DESC
                LIMIT 3;";
            $stmt = Application::$app->db->getConnection()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e)
        {
            return null;
        }
    }

    public function get7DayRevenue()
    {
        try{
                    $sql = "
                    SELECT date_range.date AS order_date, IFNULL(SUM(uo.total_amount), 0) AS daily_revenue
            FROM (
                SELECT CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS date
                FROM (SELECT 0 AS a UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) AS a
                CROSS JOIN (SELECT 0 AS a UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) AS b
                CROSS JOIN (SELECT 0 AS a UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) AS c
            ) date_range
            LEFT JOIN user_order uo ON date_range.date = uo.order_date AND uo.status = 4
            WHERE date_range.date BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()
            GROUP BY date_range.date; ";
            $stmt = Application::$app->db->getConnection()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch(Exception $e)
        {
            return null;
        }
       

    }
}