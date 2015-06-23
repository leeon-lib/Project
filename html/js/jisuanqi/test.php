<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title></title>
	<style type="text/css">


	</style>

	<script type="text/javascript">

		function getClassName(eClassName){
			var eles = document.getElementsByTagName('*');
			var arr = [];
			for (var i=0;i<eles.length;i++){
				if (eles[i].className == eClassName){
					arr.push(eles[i]);
				}
			}
			return arr;
		}

		window.onload = function(){

			var div1 = getClassName('p');
			alert(div1[2].innerHTML);
		}

	</script>
</head>
<body>

	<div class="s">
		NIHAO
		<a href="" class="p">第一</a>
		<a href="" class="p">第二</a>
		<a href="" class="p">第三</a>
	</div>

	<div class="d">
		<span class="a">第一个span</span>
		<span class="a">第二个span</span>
		<span class="aa">第三个span</span>
	</div>

</body>
</html>