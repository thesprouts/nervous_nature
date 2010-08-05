<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
	  "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <title>Nervous System | Simulation and Nature in Design</title>
    <?php require('include/header.php'); ?>
    <div class="leftColumn">
      <div class="title">Description</div>
      <div class="text">
        This course surveys techniques for dynamic simulations in
        design.  It covers topics often geared toward science,
        engineering and computer graphics, but from a slightly
        different perspective.  In science and engineering, you want
        your simulation to isolate a specific phenomena, and either
        give you some measurement or test some hypothesis.  It does
        not have to mimic reality, but provably tell you something
        about the axioms of your model.  In computer graphics, the
        only standard of rigour is that your model looks real,
        regardless of the science behind it.  It also generally needs
        to be fast.  In design the standards are completely up to you.
        You might be simulating a physical object, and therefore
        require precision.  You might be creating an interactive
        application and need speed.  You might be using these tools to
        make something completely novel, so it does not need to be
        based on physical principles or look like a physical object.
        Because of this freedom, we approach these techniques with an
        open mind.  It is not about how to work with specific
        techniques, but how understanding these techniques can be a
        generator for new ideas.  Below is a description of the topic
        for each week and a link to resources for each topic.
      </div>
      <div class="text">
        <b>Wednesdays</b> 6pm-9pm on MIT campus room 66-160<br>
        <b>Thursdays</b> 7pm-11pm at Sprout, 399R Summer St,
        Somerville<br>
      </div>
      <div class="weeks">
        <div class="week">
          <div class="weektitle"><b>Week
              1</b> <a href="sessions/introduction-and-diffusion-limited-aggregation.php">Introduction and Diffusion Limited
              Aggregation</a></div>
          <a href="week1.php"><img src="dendrite.jpg"></a>
          <div class="weektext">
            As an introduction to the idea of modeling, we will go
            over a system called diffusion limited aggregation.  The
            basics of this process is that particles move randomly and
            when they hit a static structure they stick to it.  It has
            been used to model various processes and fractal forms in
            nature including snowflakes, lightning, and dendritic
            agate.
            <p>
              <a class="line" href="math.php">Math:</a> We will also
              go over basic mathematics that will pervade the entire
              course including vectors, linear algebra, and calculus.
            </p>
          </div>
          
        </div>
        <div class="week">
          <div class="weektitle"><b>Week
              2</b> <a href="sessions/particles-integrators-and-meshes.php">Particles, Integrators, and
              Meshes</a></div>
          <a href="week2.php"><img src="radiolaria.jpg"></a>
          <div class="weektext">
            At the most primitive particle systems simulation basic
            newtonian physics on point masses.  From a simple
            foundation, however, they can be used to create complex
            systems and forms: cloths, galaxies, trees.  Also, the
            theory behind them, numerical integrators, will form the
            basis for more complex simulations of continuum phenomena.
          </div>
        </div>
	<div class="week">
          <div class="weektitle"><b>Week
              3</b> <a href="sessions/finite-difference-and-diffusion.php">Finite Difference and
              Diffusion</a></div>
          <a href="week3.php"><img src="rd.jpg"></a>
          <div class="weektext">
            We look at the phenomena of diffusion using
            finite difference simulations.  Diffusion is
            the spread of particles under random motion,
            but can be generalized to heat, economics,
            population dynamics, and many other domains.
            We also look at related the related phenomena,
            dielectric breakdown modeling and
            reaction-diffusion.
          </div>
          
        </div>
        <div class="week">
          <div class="weektitle"><b>Week
              4</b> <a href="sessions/multi-agent-systems.php">Multi-Agent
              Systems</a></div>
          <a href="week4.php"><img src="starlings.jpg"></a>
          <div class="weektext">
            Multi-agent systems are a general framework to
            think about the interaction of many
            individuals.  It is defined by agents acting
            under certain rules or behaviors based on
            their local environment.  We will look at a
            simulation of flocking known as boids and also
            talk about potential directions in traffic and
            ecology.
          </div>
          
        </div>
        <div class="week">
          <div class="weektitle"><b>Week
              5</b> <a href="sessions/fluids-and-smoothed-particles.php">Fluids and Smoothed
              Particles</a></div>
          <a href="week5.php"><img src=""></a>
          <div class="weektext">
            Smoothed Particle Hydrodynamics has become a
            common method for simulating fluids in
            real-time.  It is based on particles whose
            attributes are averaged out over space.  Here
            we introduce the basic building blocks of a
            fluid simulation using SPH.
          </div>
          
        </div>
        <div class="week">
          <div class="weektitle"><b>Week 6</b> <a href="sessions/sph-continued.php">SPH
              continued</a></div>
          <a href="week6.php"><img src=""></a>
          <div class="weektext">
            We address some advanced topics in Smoothed
            Particle Hydrodynamics.  These include fluid
            properties like surface tension and true
            incompressibility.  We also look at rendering
            techniques for visualizing particle based
            fluids.  Finally, we talk about extensions of
            the model to other phenomena.  SPH can be
            applied to any PDE problem, and here we look
            at diffusion and erosion-deposition.
          </div>
          
        </div>
        <div class="week">
          <div class="weektitle"><b>Week
              7</b> <a href="sessions/dunes.php">Dunes</a></div>
          <a href="week7.php"><img src="dunes.jpg"></a>
          <div class="weektext">
            We investigate patterns formed by wind blown
            sand.  While your first instinct might be to
            model wind as a gaseous fluid and think about
            erosion and deposition models of sand, people
            have created much simpler models for sand
            dynamics.
          </div>
          
        </div>
        <div class="week">
          <div class="weektitle"><b>Week
              8</b> <a href="week8.php">Graphics, Curves,
              and Surfaces</a></div>
          <a href="week8.php"><img src=""></a>
          <div class="weektext">
          </div>
          
        </div>
	
	
      </div>
      
    </div> <!-- first column -->
    <div class="rightColumn">
      <div class="title">Good Stuff</div>
      <div class="text">
	
        <a class="d" href="math.php">Math</a>
        <p>
          <a class="d" href="inspiration.php">Inspiration</a>
      </div>
      
    </div> <!--end right-->
</div><!--end bod-->
</body>
</html>
