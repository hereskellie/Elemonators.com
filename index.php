<?php get_header(); ?>
<div class="wrapper">
    <div class="wrapper2">
        <hr>
		<div class="level">
			<h2 style="color:white;">Level: 1</h2>
		</div>
		<div class="score">
			<h2 style="color:white;">Score: 0</h2>
		</div>
		<hr>
		<ul class="difficulty">
		<h4 style="color:white;font-family:Arial;font-weight: 900;font-size:15px;">Choose Your Difficulty</h4>

			<li>
				<input type="radio" class="difOpt" name="difficulty" value="2"><span style="color:white;">Easy</span>
			</li>
			<br />
			<li>
				<input type="radio" class="difOpt" name="difficulty" value="1" checked><span style="color:white;">Normal</span>
			</li>
			<br />
			<li>
				<input type="radio" class="difOpt" name="difficulty" value="0.5"><span style="color:white;">Hard</span>
			</li>
			<br />
			<li>
				<input type="radio" class="difOpt" name="difficulty" value="0.25"><span style="color:white;">Insane</span>
			</li>
		</ul>
		<hr>
		<br />
			<center><button class="start"><b><i>START</i></b></button></center>
		
	</div>
	<div class="wrapper3">
	<hr>
	<h3 style="color:white;">Choose Your Game Preferences</h3>
	<hr>
    <h4 style="color:white;">Do You want Text ?</h4>
    <input type="checkbox" value="No" id="text"><span style="color:white;"><b>Yes</b></span>
	<h4 style="color:white;">Do You want Flashes ?</h4>
    <input type="checkbox" value="No" id="flash"checked><span style="color:white;"><b>Yes</b></span>
	</div>
	

	
		<div class="back">
			<div class="pad shape1" data-pad="1">
				<audio preload="auto" class="sound1">
					<source src="sounds_01.mp3" type="audio/mpeg"/>
					<source src="sounds_01.ogg" type="audio/ogg"/>
				</audio>
			</div>
			<div class="pad shape2" data-pad="2">
				<audio preload="auto" class="sound2">
					<source src="sounds_02.mp3"  type="audio/mpeg"/>
					<source src="sounds_02.ogg" type="audio/ogg"/>
				</audio>
			</div>
		    <div class="Timer">
			<br />
			<br />
			<div class="TextBox">
	        <h4 style="color:White;font-family:Arial;font-weight: 900;font-size:14.2px;"><b>If You selected Text, It will Be Here </b></h4>
	        </div>
			<br />
			<br />
            <center><p style="color:White;font-family:Arial;font-weight: 900;font-size:14.2px;"><b>Time starts when you click start</b></p></center> 
			<hr>
			<hr>
			</div>


			
			<div class="pad shape3" data-pad="3">
				<audio preload="auto" class="sound3">
					<source src="sounds_03.mp3" type="audio/mpeg"/>
					<source src="sounds_03.ogg" type="audio/ogg"/>
				</audio>
			</div>
			<div class="pad shape4" data-pad="4">
				<audio preload="auto" class="sound4">
					<source src="sounds_04.mp3" type="audio/mpeg"/>
					<source src="sounds_04.ogg" type="audio/ogg"/>
				</audio>
			</div>
            
            
<?php get_footer(); ?>
