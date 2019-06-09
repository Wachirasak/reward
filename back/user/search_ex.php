<?php
// เชื่อมต่อกับฐานข้อมูล
$link=mysql_connect("localhost","root",""); // เชื่อมต่อ Server 
mysql_select_db("test");  // ติดต่อฐานข้อมูล 
mysql_query("set character set utf8"); // กำหนดค่า character set ที่จะใช้แสดงผล 
?> 
<?php
// ฟังก์ชั่นสำหรับการแบ่งหน้า NEW MODIFY
function page_navi($before_p,$plus_p,$total,$total_p,$chk_page){     
    global $urlquery_str;  
    $pPrev=$chk_page-1;  
    $pPrev=($pPrev>=0)?$pPrev:0;  
    $pNext=$chk_page+1;  
    $pNext=($pNext>=$total_p)?$total_p-1:$pNext;       
    $lt_page=$total_p-4;  
    if($chk_page>0){    
        echo "<a  href='$urlquery_str"."pages=".intval($pPrev+1)."' class='naviPN'>Prev</a>";  
    }  
    if($total_p>=11){  
        if($chk_page>=4){  
            echo "<a $nClass href='$urlquery_str"."pages=1'>1</a><a class='SpaceC'>. . .</a>";     
        }  
        if($chk_page<4){  
            for($i=0;$i<$total_p;$i++){    
                $nClass=($chk_page==$i)?"class='selectPage'":"";  
                if($i<=4){  
                echo "<a $nClass href='$urlquery_str"."pages=".intval($i+1)."'>".intval($i+1)."</a> ";     
                }  
                if($i==$total_p-1 ){   
                echo "<a class='SpaceC'>. . .</a><a $nClass href='$urlquery_str"."pages=".intval($i+1)."'>".intval($i+1)."</a> ";     
                }         
            }  
        }  
        if($chk_page>=4 && $chk_page<$lt_page){  
            $st_page=$chk_page-3;  
            for($i=1;$i<=5;$i++){  
                $nClass=($chk_page==($st_page+$i))?"class='selectPage'":"";  
                echo "<a $nClass href='$urlquery_str"."pages=".intval($st_page+$i+1)."'>".intval($st_page+$i+1)."</a> ";        
            }  
            for($i=0;$i<$total_p;$i++){    
                if($i==$total_p-1 ){   
                $nClass=($chk_page==$i)?"class='selectPage'":"";  
                echo "<a class='SpaceC'>. . .</a><a $nClass href='$urlquery_str"."pages=".intval($i+1)."'>".intval($i+1)."</a> ";     
                }         
            }                                     
        }     
        if($chk_page>=$lt_page){  
            for($i=0;$i<=4;$i++){  
                $nClass=($chk_page==($lt_page+$i-1))?"class='selectPage'":"";  
                echo "<a $nClass href='$urlquery_str"."pages=".intval($lt_page+$i)."'>".intval($lt_page+$i)."</a> ";     
            }  
        }          
    }else{  
        for($i=0;$i<$total_p;$i++){    
            $nClass=($chk_page==$i)?"class='selectPage'":"";  
            echo "<a href='$urlquery_str"."pages=".intval($i+1)."' $nClass  >".intval($i+1)."</a> ";     
        }         
    }     
    if($chk_page<$total_p-1){  
        echo "<a href='$urlquery_str"."pages=".intval($pNext+1)."'  class='naviPN'>Next</a>";  
    }  
}
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> </title>
<style type="text/css">
/* css แบ่งหน้า */
.browse_page{  
    clear:both;  
    margin-left:12px;  
    height:25px;  
    margin-top:5px;  
    display:block;  
}  
.browse_page a,.browse_page a:hover{  
    display:block;  
    width: 2%;
    font-size:14px;  
    float:left;  
    margin:0px 5px;
    border:1px solid #CCCCCC;  
    background-color:#F4F4F4;  
    color:#333333;  
    text-align:center;  
    line-height:22px;  
    font-weight:bold;  
    text-decoration:none;  
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}  
.browse_page a:hover{  
    border:1px solid #CCCCCC;
    background-color:#999999;
    color:#FFFFFF;  
}  
.browse_page a.selectPage{  
    display:block;  
    width:45px;  
    font-size:14px;  
    float:left;  
    margin-right:2px;  
    border:1px solid #CCCCCC;
    background-color:#999999;
    color:#FFFFFF;  
    text-align:center;  
    line-height:22px;   
    font-weight:bold;  
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}  
.browse_page a.SpaceC{  
    display:block;  
    width:45px;  
    font-size:14px;  
    float:left;  
    margin-right:2px;  
    border:0px dotted #0A85CB;  
    background-color:#FFFFFF;  
    color:#333333;  
    text-align:center;  
    line-height:22px;  
    font-weight:bold;  
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}  
.browse_page a.naviPN{  
    width:50px;  
    font-size:12px;  
    display:block;  
/*    width:25px;   */
    float:left;  
    border:1px solid #CCCCCC;
    background-color:#999999;
    color:#FFFFFF;  
    text-align:center;  
    line-height:22px;  
    font-weight:bold;     
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
} 
/* จบ css แบ่งหน้า */
</style>
 
</head>
 
<body>
 
 
<div style="margin:auto;text-align:left;width:700px;">
<!--ส่วนสร้างฟอร์ม สำหรับค้นหา -->
<form id="form_search" name="form_search" method="get" action="">
  <input type="text" name="keyword" id="keyword" />
  <input type="submit" name="button" id="button" value="ค้นหา" />
</form>
 
 
<br />
 
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="00">
<tbody>
  <tr>
    <td align="left" >
 <br />
 
    <table width="100%" border="1" cellspacing="0" cellpadding="2" style="border-collapse:collapse;">
        <tr>
        <td width="50" height="20" align="center" bgcolor="#F2F2F2">#</td>
        <td height="20" bgcolor="#F2F2F2">&nbsp; Topic</td>
        </tr>
<?php
        $i=1;
        $q="SELECT * FROM  province_th WHERE 1 ";
        // เงื่อนไขการค้นหา ถ้ามีการส่งค่า ตัวแปร $_GET['keyword']
        if(isset($_GET['keyword']) && $_GET['keyword']!=""){
            // ต่อคำสั่ง sql
            $q.=" AND province_name LIKE '%".trim($_GET['keyword'])."%' "; 
        }
        $qr=@mysql_query($q);  
         
        $total=@mysql_num_rows($qr);
        $e_page=10; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า  
        if(!isset($_GET['pages'])){  
            $_GET['pages']=0;  
        }else{  
            $_GET['pages']=$_GET['pages']-1;
            if($_GET['pages']<0){
                $_GET['pages']=0;  
            }
            $chk_page=$_GET['pages'];    
            $_GET['pages']=$_GET['pages']*$e_page;  
        }  
        $q.=" ORDER BY province_id DESC  LIMIT ".$_GET['pages'].",$e_page";
             
        $qr=@mysql_query($q);  
        if(@mysql_num_rows($qr)>=1){  
            $plus_p=($chk_page*$e_page)+@mysql_num_rows($qr);  
        }else{  
            $plus_p=($chk_page*$e_page);      
        }  
        $total_p=ceil($total/$e_page);  
        $before_p=($chk_page*$e_page)+1; 
        /// END PAGE NAVI ZONE         
         
        while($rs=@mysql_fetch_array($qr)){
?> 
  <tr>
    <td width="60" height="20" align="center"><?=(($e_page*$chk_page)+$i)?></td>
    <td height="20">&nbsp;<?=$rs['province_name']?></td>
  </tr>
<?php $i++; } ?>    
    </table>
     
    <br />
 
    </td>
  </tr>
</tbody>
 
 
<thead>
  <tr>
    <td align="left">
     
  
 <div style="margin:auto;width:100%;">
  <?php if($total>10){ ?>                 
  <div class="browse_page">  
    <?php     
    if(count($_GET)<=1){
        $urlquery_str="?";
    }else{
        $para_get="";
        foreach($_GET as $key=>$value){
            if($key!="pages"){
                $para_get.=$key."=".$value."&";
            }
        }
        $urlquery_str="?$para_get";
    }
    // เรียกใช้งานฟังก์ชั่น สำหรับแสดงการแบ่งหน้า     
    page_navi($before_p,$plus_p,$total,$total_p,$chk_page);      
    ?>
    </div>  
    <?php } ?> 
</div>   
     
     
    </td>
  </tr>
  <tr>
  <td height="30" align="left">&nbsp;</td>
  </tr>
</thead> 
 
<tfoot>
  <tr>
  <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">
 
 <div style="margin:auto;width:100%;">
     <?php if($total>10){ ?>                 
    <div class="browse_page">  
    <?php     
    // เรียกใช้งานฟังก์ชั่น สำหรับแสดงการแบ่งหน้า     
    page_navi($before_p,$plus_p,$total,$total_p,$chk_page);      
    ?>
    </div>  
    <?php } ?>    
</div> 
     
    </td>
  </tr>
</tfoot>   
</table>
 
</div>
 
 
</body>
</html>
