<?php
class Manage
{
    private $con;

    public function __construct()
    {
        include_once '../database/user-db.php';
        $db = new Database();
        $this->con = $db->connect();
    }

    private function pagination($con, $table, $pno, $n)
    {
        $query = $con->query("SELECT COUNT(*) as rowss FROM $table");
        $row = mysqli_fetch_assoc($query);
        $pageNum = $pno;
        $NumOfRecordsPerPage = $n;

        $last = ceil($row["rowss"] / $NumOfRecordsPerPage);

        // echo "Total Number of Pages: " . $last . "<br/>";

        $pagination = "<ul class='pagination'>";

        if ($last != 1) {
            if ($pageNum > 1) {
                $previous = "";
                $previous = $pageNum - 1;
                $pagination .= "<li class='page-item'><a class='page-link' href='javascript:void(0)' pn=' " . $previous . "'>Previous  </a>";

            }
            for ($i = $pageNum - 5; $i < $pageNum; $i++) {
                if ($i > 0) {
                    $pagination .= "<li class='page-item'><a class='page-link' href='javascript:void(0)' pn='" . $i . "'>" . $i . "</a></li>";
                }
            }
            $pagination .= "<li class='page-item'><a class='page-link' href='javascript:void(0)' pn='" . $pageNum . "' style='background-color:#4B56B9; color: white;'> $pageNum </a></li>";
            for ($i = $pageNum + 1; $i <= $last; $i++) {
                $pagination .= "<li class='page-item'><a class='page-link' href='javascript:void(0)' pn='" . $i . "'>" . $i . "</a></li>";
                if ($i > $pageNum + 5) {
                    break;
                }
            }
            if ($last > $pageNum) {
                $next = $pageNum + 1;
                $pagination .= "<li class='page-item'><a class='page-link' href='javascript:void(0)' pn='" . $next . "' '>  Next</a></li></ul>";
            }
        }
        $limit = "LIMIT " . ($pageNum - 1) * $NumOfRecordsPerPage . "," . $NumOfRecordsPerPage;
        // $pageNum = $_GET['pageNum'];
        return ["pagination" => $pagination, "limit" => $limit];

    }

    public function manageTableWithPagination($table, $pno, $col)
    {
        $a = $this->pagination($this->con, $table, $pno, 5);

        if ($table == "product") {
            $sql = "SELECT
                        p.id,
                        p.name,
                        c.name AS category,
                        v.name AS vendor,
                        p.stock,
                        p.cost_price,
                        p.selling_price,
                        p.profit,
                        p.updated_date,
                        p.status
                    FROM
                        product p
                    LEFT JOIN product_category c ON
                        p.category_id = c.id
                    LEFT JOIN product_vendor v ON
                        p.vendor_id = v.id ";
            if ($col) {
                $sql .= " ORDER BY $col ";
            }
            $sql .= $a["limit"];
        } else {
            $sql = "SELECT * FROM $table " . $a['limit'];
        }
        $result = $this->con->query($sql) or die($this->con->error);
        $rows = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return ['rows' => $rows, 'pagination' => $a["pagination"]];
    }

    public function fetchProductMeta(){
        $sql = "SELECT
                    COUNT(id) AS total,
                    SUM(stock) AS total_stock,
                    (
                    SELECT
                        COUNT(id)
                    FROM
                        product
                    WHERE
                STATUS
                    = '1'
                ) AS active
                FROM
                    product";
        
        $result = $this->con->query($sql) or die($this->con->error);
        if($result){
            return $result->fetch_assoc();
        };
    }

    public function deleteRecord($table, $pk, $id)
    {
        if ($table == "pdcts_categories") {
            $prep_stmt = $this->con->prepare("SELECT $id FROM pdcts_categories WHERE parent_cat = ?");
            $prep_stmt->bind_param('i', $id);
            $prep_stmt->execute() or die($this->con->error);

            $result = $prep_stmt->get_result();
            if ($result->num_rows > 0) {
                return "DEPENDENT_CATEGORY";
            } else {
                $prep_stmt = $this->con->prepare("DELETE FROM $table WHERE $pk = ?");
                $prep_stmt->bind_param("i", $id);
                $result = $prep_stmt->execute() or die($this->con->error);
                if ($result) {
                    return "CATEGORY_DELETED";
                }
            }
        } else {
            $prep_stmt = $this->con->prepare("DELETE FROM $table WHERE $pk = ?");
            $prep_stmt->bind_param("i", $id);
            $result = $prep_stmt->execute() or die($this->con->error);
            if ($result) {
                return "RECORD_DELETED";
            }
        }
    }

    public function getSingleRecord($table, $pk, $id)
    {
        $prep_stmt = $this->con->prepare("SELECT * FROM $table WHERE $pk = ?");
        $prep_stmt->bind_param("i", $id);
        $prep_stmt->execute() or die($this->con->error);
        $result = $prep_stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return "RECORD_NOT_FOUND";
        }
    }

    public function update_record($table, $where, $fields)
    {
        $sql = "";
        $condition = "";

        // WHERE  id = '5' AND name = 'something'
        foreach ($where as $key => $value) {
            $condition .= "$key = '$value' AND ";
        }
        $condition = substr($condition, 0, -5);
        // SET  lname = 'epg' fav = 'mango'
        foreach ($fields as $key => $value) {
            $sql .= "$key = '$value', ";
        }
        $sql = substr($sql, 0, -2);

        $sql = "UPDATE $table SET $sql WHERE $condition";
        // return $sql;

        if (mysqli_query($this->con, $sql)) {
            return "TABLE_UPDATED";
        } else {
            return $this->con->error;
        }
    }


}

// $obj = new Manage();
