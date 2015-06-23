//鼠标事件，进入/移出搜索表单元素中时，改变搜索按钮的背景颜色
function searchFormBtn(x){
	if(x){
		document.getElementById("ss1").style.backgroundColor="#ff4a00";
	}else{
		document.getElementById("ss1").style.backgroundColor="white";
	}
}

//点击/移出搜索框时，隐藏/显示搜索热词
function hiddenHotWords(x){
	if(x){
		document.getElementById("hotWords").style.display="none";
	}else{
		document.getElementById("hotWords").style.display="block";
	}
}

function searchCartMouseOver(){
	document.getElementById("cart").getElementsByTagName("A")[0].style.color="#ff4a00";
	document.getElementById("cart").getElementsByTagName("A")[0].style.border="1px solid #ff4a00";
	document.getElementById("cart").getElementsByTagName("A")[0].style.height="20px";
	document.getElementById("cart").getElementsByTagName("A")[0].style.width="104px";
	document.getElementById("cart").getElementsByTagName("A")[0].style.backgroundColor="#fff";
}
function searchCartMouseOut(){
	document.getElementById("cart").getElementsByTagName("A")[0].style.color="black";
	document.getElementById("cart").getElementsByTagName("A")[0].style.border="none";
	document.getElementById("cart").getElementsByTagName("A")[0].style.height="20px";
	document.getElementById("cart").getElementsByTagName("A")[0].style.width="104px";	
	document.getElementById("cart").getElementsByTagName("A")[0].style.backgroundColor="#ffdb3d";
	document.getElementById("cart").getElementsByTagName("A")[0].style.border="1px solid #ffdb3d";
}