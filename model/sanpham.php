<?php
function loadall_sanpham_home(){
    $sql="select * from sanpham where 1 order by id desc limit 0,9";
    $listsanpham=pdo_query($sql);
    return  $listsanpham;
}
function loadall_sanpham_top10(){
    $sql="select * from sanpham where 1 order by luotxem desc limit 0,10";
    $listsanpham=pdo_query($sql);
    return $listsanpham;
}
function loadall_sanpham($keyw="",$iddm=0){
    $sql="SELECT * from sanpham where trangthai = 0";
    // where 1 tức là nó đúng
    if($keyw!=""){
        $sql.=" and name like '%".$keyw."%'";
    }
    if($iddm>0){
        $sql.=" and iddm ='".$iddm."'";
    }
    $sql.=" order by id desc";
    $listsanpham=pdo_query($sql);
    return  $listsanpham;
}

// 
function loadone_sanpham($id){
    $sql = "select * from sanpham where id = ".$id;
    $result = pdo_query_one($sql);
    return $result;
}
function load_sanpham_cungloai($id, $iddm){
    $sql = "select * from sanpham where iddm = $iddm and id <> $id";
    $result = pdo_query($sql);
    return $result;
}
function insert_sanpham($tensp,$giasp, $hinh, $mota, $iddm){
    $sql = "INSERT INTO `sanpham`(`name`, `price`, `img`, `mota`, `iddm`) VALUES ('$tensp', '$giasp', '$hinh', '$mota', '$iddm');";
    pdo_execute($sql);
}
function update_sanpham($id,$iddm,$tensp,$giasp,$mota,$hinh){
    if($hinh!=""){
        // $sql="update sanpham set iddm='".$iddm."',name='".$tensp."',price='".$giasp."',mota='".$mota."',img='".$hinh."' where id=".$id;
        $sql=  "UPDATE `sanpham` SET `name` = '{$tensp}', `price` = '{$giasp}', `mota` = '{$mota}',`img` = '{$hinh}', `iddm` = '{$iddm}' WHERE `sanpham`.`id` = $id";
    }else{
        //  $sql="update sanpham set iddm='".$iddm."',name='".$tensp."',price='".$giasp."',mota='".$mota."' where id=".$id;
        $sql=  "UPDATE `sanpham` SET `name` = '{$tensp}', `price` = '{$giasp}', `mota` = '{$mota}', `iddm` = '{$iddm}' WHERE `sanpham`.`id` = $id";
    }
    pdo_execute($sql);
}

// Câu truy vấn xóa cứng
function hard_delete($id){
    $sql = "DELETE FROM sanpham WHERE id=" .$id;
    pdo_execute($sql);
}

// cÂU TRUY VẤN XÓA MỀM
function soft_delete($id){
    $sql = "UPDATE `sanpham` SET `trangthai` = 1 WHERE `sanpham`.`id` = $id";
    pdo_execute($sql);
}
