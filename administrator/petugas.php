<?php require_once('../Connections/konek.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rspetugas = 10;
$pageNum_rspetugas = 0;
if (isset($_GET['pageNum_rspetugas'])) {
  $pageNum_rspetugas = $_GET['pageNum_rspetugas'];
}
$startRow_rspetugas = $pageNum_rspetugas * $maxRows_rspetugas;

mysql_select_db($database_konek, $konek);
$query_rspetugas = "SELECT * FROM petugas";
$query_limit_rspetugas = sprintf("%s LIMIT %d, %d", $query_rspetugas, $startRow_rspetugas, $maxRows_rspetugas);
$rspetugas = mysql_query($query_limit_rspetugas, $konek) or die(mysql_error());
$row_rspetugas = mysql_fetch_assoc($rspetugas);

if (isset($_GET['totalRows_rspetugas'])) {
  $totalRows_rspetugas = $_GET['totalRows_rspetugas'];
} else {
  $all_rspetugas = mysql_query($query_rspetugas);
  $totalRows_rspetugas = mysql_num_rows($all_rspetugas);
}
$totalPages_rspetugas = ceil($totalRows_rspetugas/$maxRows_rspetugas)-1;

$queryString_rspetugas = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rspetugas") == false && 
        stristr($param, "totalRows_rspetugas") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rspetugas = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rspetugas = sprintf("&totalRows_rspetugas=%d%s", $totalRows_rspetugas, $queryString_rspetugas);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	background: #4E5869;
	margin: 0;
	padding: 0;
	color: #000;
}

/* ~~ Element/tag selectors ~~ */
ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists. For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain. Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
	padding-right: 15px;
	padding-left: 15px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
}
a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
	border: none;
}

/* ~~ Styling for your site's links must remain in this order - including the group of selectors that create the hover effect. ~~ */
a:link {
	color:#414958;
	text-decoration: underline; /* unless you style your links to look extremely unique, it's best to provide underlines for quick visual identification */
}
a:visited {
	color: #4E5869;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* this group of selectors will give a keyboard navigator the same hover experience as the person using a mouse. */
	text-decoration: none;
}

/* ~~ this container surrounds all other divs giving them their percentage-based width ~~ */
.container {
	width: 80%;
	max-width: 1260px;/* a max-width may be desirable to keep this layout from getting too wide on a large monitor. This keeps line length more readable. IE6 does not respect this declaration. */
	min-width: 780px;/* a min-width may be desirable to keep this layout from getting too narrow. This keeps line length more readable in the side columns. IE6 does not respect this declaration. */
	background: #FFF;
	margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout. It is not needed if you set the .container's width to 100%. */
}

/* ~~ the header is not given a width. It will extend the full width of your layout. It contains an image placeholder that should be replaced with your own linked logo ~~ */
.header {
	background: #6F7D94;
}

/* ~~ These are the columns for the layout. ~~ 

1) Padding is only placed on the top and/or bottom of the divs. The elements within these divs have padding on their sides. This saves you from any "box model math". Keep in mind, if you add any side padding or border to the div itself, it will be added to the width you define to create the *total* width. You may also choose to remove the padding on the element in the div and place a second div within it with no width and the padding necessary for your design.

2) No margin has been given to the columns since they are all floated. If you must add margin, avoid placing it on the side you're floating toward (for example: a right margin on a div set to float right). Many times, padding can be used instead. For divs where this rule must be broken, you should add a "display:inline" declaration to the div's rule to tame a bug where some versions of Internet Explorer double the margin.

3) Since classes can be used multiple times in a document (and an element can also have multiple classes applied), the columns have been assigned class names instead of IDs. For example, two sidebar divs could be stacked if necessary. These can very easily be changed to IDs if that's your preference, as long as you'll only be using them once per document.

4) If you prefer your nav on the right instead of the left, simply float these columns the opposite direction (all right instead of all left) and they'll render in reverse order. There's no need to move the divs around in the HTML source.

*/
.sidebar1 {
	float: left;
	width: 20%;
	background: #93A5C4;
	padding-bottom: 10px;
}
.content {
	padding: 10px 0;
	width: 80%;
	float: left;
}

/* ~~ This grouped selector gives the lists in the .content area space ~~ */
.content ul, .content ol { 
	padding: 0 15px 15px 40px; /* this padding mirrors the right padding in the headings and paragraph rule above. Padding was placed on the bottom for space between other elements on the lists and on the left to create the indention. These may be adjusted as you wish. */
}

/* ~~ The navigation list styles (can be removed if you choose to use a premade flyout menu like Spry) ~~ */
ul.nav {
	list-style: none; /* this removes the list marker */
	border-top: 1px solid #666; /* this creates the top border for the links - all others are placed using a bottom border on the LI */
	margin-bottom: 15px; /* this creates the space between the navigation on the content below */
}
ul.nav li {
	border-bottom: 1px solid #666; /* this creates the button separation */
}
ul.nav a, ul.nav a:visited { /* grouping these selectors makes sure that your links retain their button look even after being visited */
	padding: 5px 5px 5px 15px;
	display: block; /* this gives the link block properties causing it to fill the whole LI containing it. This causes the entire area to react to a mouse click. */
	text-decoration: none;
	background: #8090AB;
	color: #000;
}
ul.nav a:hover, ul.nav a:active, ul.nav a:focus { /* this changes the background and text color for both mouse and keyboard navigators */
	color: #FFF;
	background-color: #000;
}

/* ~~ The footer ~~ */
.footer {
	padding: 10px 0;
	background: #6F7D94;
	position: relative;/* this gives IE6 hasLayout to properly clear */
	clear: both; /* this clear property forces the .container to understand where the columns end and contain them */
}

/* ~~ miscellaneous float/clear classes ~~ */
.fltrt {  /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page. The floated element must precede the element it should be next to on the page. */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class can be placed on a <br /> or empty div as the final element following the last floated div (within the #container) if the #footer is removed or taken out of the #container */
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
-->
</style><!--[if lte IE 7]>
<style>
.content { margin-right: -1px; } /* this 1px negative margin can be placed on any of the columns in this layout with the same corrective effect. */
ul.nav a { zoom: 1; }  /* the zoom property gives IE the hasLayout trigger it needs to correct extra whiltespace between the links */
</style>
<![endif]--></head>

<body>

<div class="container">
  <div class="header"><img src="../img/kop.jpg" width="1231" height="113" /><!-- end .header --></div>
    <div class="footer"><?php include("menu.PHP"); ?>
    <p>&nbsp;</p>
    <!-- end .footer --></div>
  <div class="sidebar1">
    <ul class="nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="suratmasuk.php">Surat Masuk</a></li>
      <li><a href="disposisi.php">Disposisi</a></li>
      <li><a href="suratkeluar.php">Surat Keluar</a></li>
      <li><a href="petugas.php">Petugas</a></li>
      
    </ul>
    <p>&nbsp;</p>
    <!-- end .sidebar1 --></div>
  <div class="content">
    <h1>DATA PETUGAS</h1>
    <p>&nbsp;</p>
    <table border="1">
      <tr bgcolor="#00FFFF">
        <td><div align="center">id</div></td>
        <td><div align="center">nama_depan</div></td>
        <td><div align="center">nama _belakang</div></td>
        <td><div align="center">password</div></td>
        <td><div align="center">hak</div></td>
        <td><div align="center">Aksi</div></td>
      </tr>
      <?php do { ?>
        <tr>
          <td><?php echo $row_rspetugas['id']; ?></td>
          <td><?php echo $row_rspetugas['nama_depan']; ?></td>
          <td><?php echo $row_rspetugas['nama _belakang']; ?></td>
          <td><?php echo $row_rspetugas['password']; ?></td>
          <td><?php echo $row_rspetugas['hak']; ?></td>
          <td><a href="petugasedit.php?id=<?php echo $row_rspetugas['id']; ?>">Edit</a> <a href="petugashapus.php?id=<?php echo $row_rspetugas['id']; ?>">Hapus</a></td>
        </tr>
        <?php } while ($row_rspetugas = mysql_fetch_assoc($rspetugas)); ?>
    </table>
<p>&nbsp;

<table border="0">
  <tr>
    <td><?php if ($pageNum_rspetugas > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rspetugas=%d%s", $currentPage, 0, $queryString_rspetugas); ?>">First</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_rspetugas > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rspetugas=%d%s", $currentPage, max(0, $pageNum_rspetugas - 1), $queryString_rspetugas); ?>">Previous</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_rspetugas < $totalPages_rspetugas) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rspetugas=%d%s", $currentPage, min($totalPages_rspetugas, $pageNum_rspetugas + 1), $queryString_rspetugas); ?>">Next</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_rspetugas < $totalPages_rspetugas) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rspetugas=%d%s", $currentPage, $totalPages_rspetugas, $queryString_rspetugas); ?>">Last</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
Jumlah: 
<?php echo $totalRows_rspetugas ?>
</p>
    <!-- end .content --></div>
  <div class="footer">
    <p><center>UKK RPL 1 2018</center></p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>
<?php
mysql_free_result($rspetugas);
?>
