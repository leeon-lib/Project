<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>简易计算器</title>

	<style type="text/css">
		*{ padding: 0px; margin: 0px; border: 0;}
		body{ font-size: 25px; }
		a{ text-decoration: none;color: #000; }
		a:hover{ background: #999; }
		.num{ font-size: 38px; }
		.sign a{ font-size: 55px;background: #FF8F3E;color: #fff; }
		.sign a:hover{ background: #FF702C; }
		table{ height: 500px;margin: 50px auto;}
		table td{ width:120px;text-align: center; border:1px solid #000; }
		td a{ display: block;background: #ccc;line-height: 90px; }
		/*.row_res{ margin-right: 10px; }*/
		.row_res td{ height: 120px;line-height: 120px;color:#fff;font-size:50px;text-align:right;background: #333;}
	</style>

	<script src="jquery-1.7.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">

		// 以类名取得元素
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
//		evt,evtName,Obj,funName
		function attEvt(){
//			var ev = window.event ||evt;
//			var eN = evtName;
//			var obj = Obj;
//			var fN = funName;
//			var brsName = 'ie';
			var ua = navigator.userAgent.toLowerCase();
			
			if (ua.indexOf("mise") >= 0){
				brsName = 'ie';
			}else{
				brsName = 'other';
			}
			return ua;
		}
		
		
		
		window.onload = function(){
			var brs = attEvt();
//			document.write(brs);
		}
		

	</script>
</head>
<body>

	<div id="container">
		
		<table>
			<tr class="row_res">
				<td colspan="5">100</td>
			</tr>
			<tr>
				<td colspan="2"><a href="javascript:void(0)">ON/OFF</a></td>
				<td><a href="javascript:void(0)">Reset</a></td>
				<td class="sign"><a href="javascript:void(0)">+</a></td>
			</tr>
			<tr>
				<td class="num"><a href="javascript:void(0)">9</a></td>
				<td class="num"><a href="javascript:void(0)">8</a></td>
				<td class="num"><a href="javascript:void(0)">7</a></td>
				<td class="sign"><a href="javascript:void(0)">-</a></td>
			</tr>
			<tr>
				<td class="num"><a href="javascript:void(0)">6</a></td>
				<td class="num"><a href="javascript:void(0)">5</a></td>
				<td class="num"><a href="javascript:void(0)">4</a></td>
				<td class="sign"><a href="javascript:void(0)">*</a></td>
			</tr>
			<tr>
				<td class="num"><a href="javascript:void(0)">3</a></td>
				<td class="num"><a href="javascript:void(0)">2</a></td>
				<td class="num"><a href="javascript:void(0)">1</a></td>
				<td class="sign"><a href="javascript:void(0)">/</a></td>
			</tr>
			<tr>
				<td class="num" colspan="2"><a href="javascript:void(0)">0</a></td>
				<td class="num"><a href="javascript:void(0)">.</a></td>
				<td class="sign"><a href="javascript:void(0)">=</a></td>
			</tr>
		</table>
	</div>

</body>
</html>