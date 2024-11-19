<?php
class Items extends Db
{
    public function getAllItems()
    {
        $sql = self::$connection->prepare("SELECT * FROM items");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    public function getNewItems($start, $count)
    {
        $sql = self::$connection->prepare("SELECT * FROM items ORDER BY created_at DESC LIMIT ?, ?");
        $sql->bind_param("ii", $start, $count);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    public function getFeatureNew()
    {
        $sql = self::$connection->prepare("SELECT * FROM items WHERE featured = 1 ORDER BY created_at DESC");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function getLastNew($limit)
    {
        $sql = self::$connection->prepare("SELECT * FROM items ORDER BY created_at DESC LIMIT ?");
        $sql->bind_param("i", $limit);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    //search có tham số
    public function SearchItem($keyword, $start, $count)
    {
        $sql = self::$connection->prepare('SELECT * FROM `items` 
        WHERE `content` 
        LIKE ? LIMIT ?,?');
        $keyword = "%$keyword%";
        $sql->bind_param("sii", $keyword, $start, $count);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    //search tất cả item
    public function SearchAllItem($keyword)
    {
        $sql = self::$connection->prepare('SELECT * FROM `items` 
        WHERE `content` 
        LIKE ?');
        $keyword = "%$keyword%";
        $sql->bind_param("s", $keyword);
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    public function GetAllCateById($cate_id)
    {
        $sql = self::$connection->prepare('SELECT * FROM `items` 
        WHERE `category` = ?');
        $sql->bind_param("i", $cate_id);
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    public function GetItemsByCate($cate_id, $page, $count)
    {
        $start = ($page - 1) * $count;
        $sql = self::$connection->prepare('SELECT * FROM `items` 
        WHERE `category` = ? LIMIT ?,?');
        $sql->bind_param("iii", $cate_id, $start, $count);
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    function Paginate($url, $total, $perPage)
    {
        $totalLinks = ceil($total / $perPage);
        $link = "";
        for ($j = 1; $j <= $totalLinks; $j++) {
            $link = $link . "<a class = 'badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2' href='$url&page=$j'> $j </a>";
        }
        return $link;
    }

    //Search tất cả items và phân trang
    public function SearchAndPaginate($keyword, $page, $count)
    {
        $start = ($page - 1) * $count;
        $keyword = "%$keyword%";

        // Lấy tổng số kết quả tìm kiếm
        $sqlTotal = self::$connection->prepare('SELECT COUNT(*) as total FROM `items` WHERE `content` LIKE ?');
        $sqlTotal->bind_param("s", $keyword);
        $sqlTotal->execute();
        $total = $sqlTotal->get_result()->fetch_assoc()['total'];

        // Lấy dữ liệu phân trang
        $sql = self::$connection->prepare('SELECT * FROM `items` WHERE `content` LIKE ? LIMIT ?, ?');
        $sql->bind_param("sii", $keyword, $start, $count);
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        return [
            'data' => $items,
            'total' => $total,
            'total_pages' => ceil($total / $count),
        ];
    }
}
