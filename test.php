<html>
<head>
<style>
div.background
  {
  width:500px;
  height:250px;
  background:url(image/cia.jpg) repeat;
  border:2px solid black;
  }
div.transbox
  {
  width:400px;
  height:180px;
  margin:30px 50px;
  background-color:#ffffff;
  border:1px solid black;
  opacity:0.6;
  filter:alpha(opacity=60); 
  }
div.transbox p
  {
  margin:30px 40px;
  font-weight:bold;
  color:#000000;
  }
</style>
</head>

<body>
<?

$arr = array(1, 2, 3, 4);

$arr = array();

print_r($arr);
// $arr is now array(2, 4, 6, 8)
unset($value); // break the reference with the last element

?>
</body>
</html>