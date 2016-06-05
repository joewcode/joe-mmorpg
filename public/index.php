<?php

if ( isset($_GET['exit']) )
{
	setcookie('AuthKey', '', time()-60, "/");
}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>Aloneislands: бесплатная ролевая браузерная онлайн (online) игра MMORPG free games on-line</title>
	
	<meta name="description" content="Фэнтези онлайн игра с элементами стратегии, квестовой частью и возможностью самим участвовать в создании нового мира , присутвует механика и магия. Возможность выбора расы!">
	<meta name='keywords' content="игра, играть, рпг, онлайн, online, fantasy, фэнтези, квест, алхимия, мир, земли, стратегия, магия, стихия, арена, бои, клан, семья, братство, сражение, тьма, свет, хаос, сумерки, удар, меч, нож, топор, дубина, щит, броня, доспех, шлем, перчатки, амулет, кулон, кольцо, пояс, зелья, карта, замки, шахты, лавка, таверна, артефакты, раритеты, свитки, свиток, школа, од, рыцарь, маг, друид, гоблин, орк, призрак, эльф, отдых, развлечение, чат, общение, знакомства, форум, власть, золото, серебро, телепорт, банк, рынок, мастерская, тактика, больница, храм, бог, демон, защита, сила, удача, ловкость, война, орден, аптека, почта, реторта, ступка, пестик, дистиллятор , механоид , оборотень , осрова , alone , islands , aloneislands , сила , реакция , воля , интелект , оружие , пистолет , балиста">
	
	<link rel="stylesheet" href="/css/index.css" type="text/css" media="screen">

	<script type="text/javascript" language="javascript" src="/js/index.js"></script>
</head>
<body bgcolor="#CFCFCF" topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" style="overflow:hidden;" scroll=no>
<script>

<?php
	echo  "index('".$_GET['error']."');"; 
?>

</script>

</body>
</html>