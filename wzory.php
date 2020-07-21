<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Michał Barełkowski</title>	
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Lato:400,900&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
	
		<script type="text/javascript">
	    function fun1(t, T1, T2, K) {
            var e_function = Math.exp(-t/T1);
            var y_values = K*(1-e_function);
            //console.log(y_values);
            return y_values;}
        function fun2(t, T1, T2, K) {
            var e_function = Math.exp(-t/T1);
		    var e_function2 = Math.exp(-t/T2);
            var y_values_II = K*(1-(T1/(T1-T2))*(e_function)+(T2/(T1-T2))*(e_function2));
            //console.log(e_function2, y_values_II);
            return y_values_II;}

        function draw() {
            //window.location.reload(false);
            var canvas = document.getElementById("canvas");
            if (null==canvas || !canvas.getContext) return;

            var axes={}, 
            ctx=canvas.getContext("2d");
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            axes.x0 = .5 + .05*canvas.width;  // x0 pixels from left to x=0
            axes.y0 = .5 + 0.95*canvas.height; // y0 pixels from top to y=0
            axes.scale = 30;                 // 40 pixels from x=0 to x=1
            axes.doNegativeX = false;
            axes.doNegativeY = false;

            showAxes(ctx,axes);
            //funGraph(ctx,axes,fun1,"rgb(11,153,11)",1); 
            funGraph(ctx,axes,fun2,"rgb(66,44,255)",2);
        }

        function funGraph (ctx,axes,func,color,thick) {
            var xx, yy, dx=4, x0=axes.x0, y0=axes.y0, scale=axes.scale;
            var iMax = Math.round((ctx.canvas.width-x0)/dx);
            var iMin = axes.doNegativeX ? Math.round(-x0/dx) : 0;
            ctx.beginPath();
            ctx.lineWidth = thick;
            ctx.strokeStyle = color;

            var K = 10;
            var T1 = 8;
            var T2 = 7;

            var ilosc = 50;
            var t = [];
            for(var i=0; i<ilosc; i++){
                t[i] = i/2;
            }

            for (var i=0;i<ilosc;i++) {
            xx = scale*t[i]; 
            //console.log(typeof(parseInt(T1.value)), T2.value, K.value);
            yy = scale*func(xx/10,T1,T2,K);
            if (i==iMin) ctx.moveTo(x0+xx,y0-yy);
            else         ctx.lineTo(x0+xx,y0-yy);
            }
            ctx.stroke();
        }

        function showAxes(ctx,axes) {
            var x0=axes.x0, w=ctx.canvas.width;
            var y0=axes.y0, h=ctx.canvas.height;
            var xmin = axes.doNegativeX ? 0 : x0;
            ctx.beginPath();
            ctx.strokeStyle = "rgb(128,128,128)"; 
            ctx.moveTo(xmin,y0); ctx.lineTo(w,y0);  // X axis
            ctx.moveTo(x0,0);    ctx.lineTo(x0,h);  // Y axis
            ctx.stroke();
        }
	</script>

	
</head>

<body onLoad="draw()">
	
	<div id="container">
	
		<div id="logo">
			Projekt zaliczeniowy - Aplikacje Internetowe
		</div>
		
		<div id="topbar">
			<div id="topbarL">
				<img src="politechnik.jpg" />
			</div>
			<div id="topbarR">
				<span class="bigtitle">Witaj na mojej stronie!</span>
				<div style="height: 15px;"></div>
				Strona zawiera elementy wymagane do zaliczenia przedmiotu takie jak: wzory matematyczne, galeria zdjęć, gra interaktywna, czy formularz logowania. Każdy z nich znajduje się na osobnej podstronie umieszczonej w nawigacji po lewej stronie ekranu. <br> Życzę miłego oglądania!
			</div>
			<div style="clear:both;"></div>
		</div>
		
		<div id="sidebar" style="height: 790px;">
			<a href ='index.php' class = 'tilelink'><div class="optionL">Strona główna</div></a>
			<a href ='wzory.php' class = 'tilelink'><div class="optionL">Wzory</div></a>
			<a href ='galeria.php' class = 'tilelink'><div class="optionL">Galeria</div></a>
			<a href ='gra.php' class = 'tilelink'><div class="optionL">Gra</div></a>
			<a href ='logowanie.php' class = 'tilelink'><div class="optionL">Logowanie</div></a>
			<a href ='rejestracja.php' class = 'tilelink'><div class="optionL">Rejestracja</div></a>
		</div>
		
		<div id="content">
			<span class="bigtitle">Wzory matematyczne</span>
			
			<div class="dottedline"></div>
			<a href="http://www.dsp.org.pl/Podstawy_teorii_sygnalow/52/">Wzór na szereg Fouriera:</a>
			<br />
			$$S(x) = {{{a_0}} \over 2} + \sum\limits_{n = 1}^\infty  {\left( {{a_n}\cos ({{2n\pi } \over T}x) + {b_n}\sin ({{2n\pi } \over T}x)} \right)} $$
			<br />
			<a href="https://pl.wikipedia.org/wiki/Cz%C5%82on_inercyjny">Człon inercyjny II rzędu:</a>
			<br />
				$$G(s) = \frac{k}{({T_1}s+1)({T_2}s+1)}$$
			<br />
			<table>
				<tr>Wykres wykonany grafiką rastrową</tr>
				<tr><td><canvas id="canvas" height="400" width="650"></canvas></td></tr>
			</table>
			</div>	
	
	<footer>
	
		<div class="socials">
			<div class="socialdivs">
				<div class="fb">
					<br>
					<a href="http://facebook.com" class="img">
					<img src="facebook.png" alt="Facebook">
					</a>
				</div>
				<div class="yt">
					<br>
					<a href="http://youtube.com" class="img">
					<img src="youtube.jpg" alt="YouTube">
					</a>
				</div>
				<div class="tw">
				<br>
					<a href="http://twitter.com" class="img">
					<img src="twitter.png" alt="Twitter">
					</a>
				</div>
				<div class="ig">
					<br>
					<a href="http://instagram.com" class="img">
					<img src="instagram.jpg" alt="Instagram">
					</a>
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
		
		<div id="footer">
			Wydział Informatyki Politechniki Poznańskiej - Automatyka i Robotyka  &copy Michał Barełkowski.
		</div>
	</footer>
	
	</div>
	
</body>
</html>