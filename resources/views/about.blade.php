@extends('layouts.admin')
@section('page_content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
    <table border="2" cellpadding="2" cellspacing="2" align="center">
        <?php
            for ($row=1; $row<=8 ; $row++) {
            echo '<tr>';
            for ($col=1; $col<=8 ; $col++) {
                $total=$row+$col;
                if ($total%2){
                    echo '<td height="30" width="30" bgcolor="black"></td>';
                }
                else {
                    echo '<td height="30" width="30" bgcolor="white"></td>';
                }
            }
            }?>
    </table>
</body>
</html>
@endsection
