<?php
$servername="localhost";
$username="root";
$password="";
$dbname="student";

$conn=mysqli_connect($servername,$username,$password,$dbname);

if($conn){
//echo "connection ok";
}
else{
echo "connection failed" .mysqli_connect_error();
}
?>


<?php
if(isset($_POST['submit'])){
    $flag=0;
    $name=$_POST['name'];
    $register=$_POST['register'];
    $query="insert into attendance(name,register) values('$name','$register');";
    $data=mysqli_query($conn,$query);
    if($data){
        $flag=1;
       echo "data inserted successfully";
       header("Location:home.php");
    }
    else{
        echo "not inserted";
    }
}
?>


<html>
<head>
    <title>Student Attendance System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style>
    #b{
        position:relative;
        
        height:100px;
        text-align:center;
        font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        color:green;
        background-color: cyan;
    }
    #a{
        position:relative;
        top:20px;
        right:-200px;
      background-color: lightskyblue;
       height:100px;
       width:800px;
        
      
    }
    #c{
        background-color:lightgreen;
        padding:5px;
        margin:30px 10px;
    }
    #d{
        background-color: lightpink;
        position:relatitve;
        
        margin:30px 10px;
        padding:5px;
        
    }
    #h{
        background-color: lightgoldenrodyellow;
        position:relatitve;
        
        margin:30px 10px;
        padding:5px;
        
    }

    #f,#f1,#f3{
        background-color: lightblue;
    }
    #o{
       
         position:relative;
         top:40px;
         width:400px;
         height:200px;
        
         left:200px;
    }
 .p{
     width:550px;
 }
 #u{
     position:relative;
     left:200px;
     background-color: lightgreen;
     height:60px;
     width:200px;
     
 }
 #e,#v,.e1{
     position:relative;
     top:40px;
     left:300px;
     width:900px;
 }
 table th,td{
     border:2px solid black;
     padding:5px;
    
 }
 .y{
     padding:25px;
     margin:5px;
     background-color: lightgreen;
 }
 .q{
     position:relative;
     
     
 }
    </style>
<script>
    function fun(){
    var a=document.getElementById('o');
    if(a.style.display=="block")
    {
        a.style.display="none";
    }
    else{
        a.style.display="block";
    }
    }

    function fun1(){
        var b=document.getElementById('e');
     
        if(b.style.display=="block")
        {
            b.style.display="none";
        }
        else{
            b.style.display="block";
        }
    }
    function fun2(){
        let b=document.getElementsByClassName('e1');
     
        if(b.style.display=="block")
        {
            b.style.display="none";
        }
        else{
            b.style.display="block";
        }
    }
    </script>
</head>

<body>
<h2 id="b">Student Attendance System</h2>
<div id="a">
<button id="c" onclick="fun()">Add student</button>
<button id="d" onclick="fun1()">Take attendance</button>
<button id="h" onclick="fun2()">View Today Attendance</button>

</div>
<div id="o">
<form method="POST"  action="home.php">
Student Name:<br>
<input type="text" name="name" id="i" class="p"><br><br>
Register Number:<br>
<input type="text" name="register" id="g" class="p"><br><br>
<input type="submit" name="submit" id="f"  >

</form>
</div>

<div id="e" >
    <form action="home.php" method="POST">
   <h3 class="q">Date:<span class="q"> <?php echo date("y-m-d") ?>  </span></h3>
    <table>
        <tr>
        <th class="y">S.no</th>
        <th class="y">Student Name</th>
        <th class="y">Register Number</th>
        <th class="y">Attendance</th>
</tr>
<?php
$result1="select * from attendance";
$sno=0;
$counter=0;
$data1=mysqli_query($conn,$result1);
while($row=mysqli_fetch_assoc($data1))
{
    $sno++;
    $counter++;
    ?>
    <tr>
    <td><?php echo $sno; ?> </td>
    <td> <?php echo $row['name']; ?> 
     <input type="hidden" value=<?php echo $row['name'];  ?> name="name[]" >       
</td>
    <td> <?php echo $row['register']; ?> 
    <input type="hidden" value=<?php echo $row['register']; ?> name="register[]"   >      
</td>
<td><input type="radio" name="status[<?php echo $counter; ?>]" value="present">Present
<input type="radio" name="status[<?php echo $counter; ?>]" value="absent">Absent
</td>

<?php } ?>

    </table>
    <br>
    <br>
    <input type="submit" value="submit" name="submit1" id="f">
</form>
</div>
<?php
error_reporting(0);
if(isset($_POST['submit1']))
{

    foreach($_POST['status'] as  $id=>$status)
    {
        $name=$_POST['name'][$id];
        $register=$_POST['register'][$id];
        $date=date("y-m-d");
        $qu="insert into records(name,register,status,date) values ('$name','$register','$status','$date');";
        if(mysqli_query($conn,$qu))
        {
        echo "data inserted";
        }
        else{
            echo "data not inserted";
        }
    }
}
?>

<div class="e1">
 <table>
        <tr>
        <th class="y">S.no</th>
        
        <th class="y">Dates</th>
        <th class="y">show</th>
</tr>

<?php
$result2="select distinct date from records";
$sno=0;

$data2=mysqli_query($conn,$result2);
while($row=mysqli_fetch_assoc($data2))
{
    $sno++;
 
    ?>
    <tr>
    <td><?php echo $sno; ?> </td>
    <td> <?php echo $row['date']; ?> 
        
</td>
<td>
<form action="home.php" method="POST">
    <input type="hidden" value="<?php echo $row['date']?>" name="date1">
    <input type="submit" value="show attendance" name="submit2" id="f1">
</form>
</tr>
</td>
<?php } ?>

    </table>
    <br>
    <br>
</div>


<?php
if(isset($_POST['submit2'])){

?>

<div class="e1" id="e2">
    
   <h3 class="q">Date:<span class="q"> <?php echo "$_POST[date1]" ?>  </span></h3>
    <table>
        <tr>
        <th class="y">S.no</th>
        <th class="y">Student Name</th>
        <th class="y">Register Number</th>
        <th class="y">Attendance</th>
        
        </tr>

<?php


$date=date("Y-m-d");
$result4="select * from records where date='$_POST[date1]'";
$sno=0;
$counter=0;
$data3=mysqli_query($conn,$result4);
if($data3)
{
    // echo "$_POST[date1]";
}
while($row=mysqli_fetch_assoc($data3))
{
    $sno++;
    $counter++;
    ?>
    
    <tr>
    <td><?php echo $sno; ?> </td>
    <td> <?php echo $row['name']; ?> 
   
</td>
    <td> <?php echo $row['register']; ?> 
         
</td>
<td><input type="radio" name="status[<?php echo $counter; ?>]" 
   <?php
   if($row['status']=="present")
   echo "checked=checked";
   ?>
value="present">Present
<input type="radio" name="status[<?php echo $counter; ?>]" 
<?php
   if($row['status']=="absent")
   echo "checked=checked";
   ?>
value="absent">Absent
</td>

<?php }} ?>

    </table>
    <br>
    <br>
   
<input type="button" value="update" id="f3" name="submit3">
</div>
</body>

</html>
