<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Tela de Apresentação Mídia Mix</title>

<style type="text/css">
	body{
		width:100%; height:100; margin-left:0px; margin-right:0px; margin-top:0px; margin-bottom:0px;}
		
	#tudo{
		width:100%; height:100; margin-left:0px; margin-right:0px; margin-top:0px; margin-bottom:0px;}	
		
	.linhas {
		width:100%; height:auto; clear:both; display:block;}
		
	.linhacentro{
		width:800px; height:auto; min-height:4px; clear:both; display:block; overflow:hidden; float:center; margin-left:auto; margin-right:auto;}	
		
	.espaco{
		float:left; display:block;}	
		
	#ERP{
		width:533px; height:112px; float:left; display:block; text-align:center; line-height:112px; font-family:Arial, Helvetica, sans-serif; font-style:normal; font-size:24px; color:#666;}
		
	@font-face {		
				font-style: normal;
				font-weight: normal;
				font-family:"erp";

				_src: url("./fonts/raleway-thin.eot"),url("./fonts/raleway-thin.otf");
				src: url("./fonts/raleway-thin.ttf");
			}			
</style>
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
</head>

<body onload="MM_preloadImages('entrar2.gif')">
	<div id="tudo">
    	<div class="linhas">
        	<div class="linhacentro" style="height:91px;"></div>
        </div>
        <div class="linhas">
        	<div class="linhacentro" style="height:151px;">
            	<div class="espaco" style="height:151px; width:264px;"></div>
                <div class="espaco" style="height:151px; width:298px; background-image:url(logo.jpg)"></div>
                <div class="espaco" style="height:151px; width:238px; background-image:url(zoody1.gif)"></div>
            </div>
        </div>
        <div class="linhas" style="background-color:#D1D1D1;">
        	<div class="linhacentro" style="height:112px;">
            	<div id="ERP">E.R.P. MÍDIAMIX SYSTEM</div>
                <div class="espaco" style="width:267px; height:112px; background-image:url(zoody2.gif)"></div>
            </div>
        </div>
        <div class="linhas" style=" height:4px; background-image:url(barradegrade.gif); background-repeat:repeat-x;">
        	<div class="linhacentro">
            	<div class="espaco" style="height:4px; width:533px;"></div>
                <div class="espaco" style="height:4px; width:267px; background-image:url(zoody3.gif)"></div>
            </div>
        </div>
        <div class="linhas">
        	<div class="linhacentro" style="height:82px;">
           	  <div class="espaco" style="width:357px; height:82px;"></div>
              <div class="espaco" style="width:106px; height:82px;"><a href="./login.jsp" target="_self" onmouseover="MM_swapImage('Image1','','entrar2.gif',1)" onmouseout="MM_swapImgRestore()"><img src="entrar1.gif" name="Image1" width="106" height="82" border="0" id="Image1" /></a></div>
              <div class="espaco" style="width:133px; height:82px;"></div>
              <div class="espaco" style="width:90px; height:82px; background-image:url(zoody4.gif);"></div>
              <div class="espaco" style="width:114px; height:82px;"></div>
          </div>
        </div>
        <div class="linhas">
        	<div class="linhacentro" style="height:110px;">
            	<div class="espaco" style="width:357px; height:110px;"></div>
                <div class="espaco" style="width:106px; height:110px; background-image:url(mix.gif);"></div>
                <div class="espaco" style="width:337px; height:110px;"></div>
            </div>
        </div>
</div>
</body></html>