<?php
include('../database/connection.php');

global $conn;
$query=$conn->prepare("delete from teachers where t_id=" . $_GET['id']);
$result=$query->execute();
if ($result) {
    echo "
<script>

        
alert('Your data has been deleted successfully');

     window.location.href = '../teacher/teacher_list.php';
</script>
";
} else {
    echo "
<script>
    alert('Error, can't delete data');
     window.location.href = '../teacher/teacher_list.php';
</script>
";
}
// header('location:index.php');
?>


