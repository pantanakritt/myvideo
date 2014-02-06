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
$ddd = opendir('image/');

while ($dd = readdir($ddd)){
echo $dd."<br>";

}
?>
</body>
</html>