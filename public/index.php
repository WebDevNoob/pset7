<?php
    // configuration
    require("../includes/config.php"); 
    // render portfolio
    $rows = query("SELECT * FROM userData WHERE id = ?", $_SESSION["id"]);
    $positions = [];
    foreach ($rows as $row){
        $stock = lookup($row["symbol"]);
        query("UPDATE userData SET name = ? WHERE symbol = ?", $stock["name"] ,$stock["symbol"]);
        if ($stock !== false){
            $positions[] = [
                "name"   => $stock["name"],
                "price"  => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"]
            ];
        }
    }
    render("portfolio.php",["title"=>"Portfolio","positions"=>$positions,"cash"=>$_SESSION["cash"]]);
?>
