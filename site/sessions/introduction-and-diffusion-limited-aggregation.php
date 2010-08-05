<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Nervous System | Simulation and Nature in Design | Week 1</title>
<?php require('../include/header.php'); ?>
	
	<div class="leftColumn">
	    <div class="title">Week 1: Introductions</div>
	    <div class="text">
	    This week will be devoted to introductions.  First, we introduce the ideas and goals of the class.  We also go over some of the basic mathematical concepts that will pervade most of the course.  The focus is not on mathematical mastery or computation, but what we are calling scientific literacy.  The goal is to be able to read and understand discourse in scientific disciplines.  Finally, we will go over in detail a simple simulation.
		<br><br>
		<ul>
		  <li>Introductions</li>
		  <li>About this seminar</li>
		  <li><a href="math.php">Math</a>
		  <ul>
		    <li>Vectors</li>
		    <li>Calculus</li>
		    <li>Linear algebra</li>
		  </ul>
		  </li>
		  <li><a href="#diffusion">Diffusion limited aggregation</a>
		  <ul>
		    <li><a href="#basic">Basic implemenation</a></li>
		    <li><a href="#opt">Optimizations</a></li>
		    <li><a href="#extend">Interaction and extension</a></li>
		  </ul>
		</li>
		</ul>
	  <p>
    <a href="math.php">Click here</a> to find tutorials and resources for mathematics.
		<br><br>
		We have a <a href="inspiration.php">page</a> to compile all the resources that everyone involved in the seminar has found that could be helpful or inspiring for projects.
		</div>
	    <br>
	    <div class="title" id="diffusion">
	    Diffusion Limited Aggregation
	    </div>
	    <div style="height:200px;width:100%;background-image:url('http://farm3.static.flickr.com/2705/4385731886_47773eacc6.jpg')"> </div>
	    <div style="height:200px;width:100%;background-image:url('http://farm4.static.flickr.com/3425/3227140341_07fa0abe57.jpg');background-position: bottom right;"> </div>
	    <div class="text">
		Diffusion limited aggregation is a technique that attempts to simulate certain forms of growth.  It is interesting in that it is both very simple and has broad applications to many diverse phenomena.  It has been used to model coral, dendritic crystals, lightning, and snowflakes.
		<p>
		The premise is that you have particles moving randomly.  This is called <a href="http://en.wikipedia.org/wiki/Brownian_motion">Brownian motion</a>, which has an interesting history in its own right.  When a particle hits a static structure, it sticks to it.  In the most basic implementation, you start with a single fixed particle and add new particles in the manner described one at a time.  The process naturally forms branches structures as the extremities of the growth act to block particles from hitting the interior parts of the static structure.
		<p>
		As our first project, we will look more indepth at different ways you might implement, interact with, and extend this system.  We will also point to further resources where you can explore this topic in more detail.  We start with a basic implementation and then show optimizations, extensions, visualization, etc.
	    </div>
	    <div class="title" id="basic">Basic Implementation</div>
	    <div class="text">
	    <img src="/media/images/dendrite.jpg" width="500px">
	     There are two approaches to a basic DLA simulation.  One works on a fixed grid and the other is grid-free and uses particles.  This difference is reflected in many simulation techniques.  Grids provide a rigid structure that simplifies the model.  In this case, a particle can only move along the grid to one of its four neighbors.  Working without a grid provides more freedom, but generally creates additional complexity, which can mean it is harder to program or requires more computation.
	     <p>
	     Here is the grid-free approach.  Note that most of the work occurs in the addCircle function.
	     <script  src="http://gist.github.com/399128.js?file=DLA_basic_free"> </script>
	     
		<p>
		Here is the grid approach.  If you run it note how the underlying grid structure effects the ultimate form.
		<script src="http://gist.github.com/399149.js?file=DLA_basic_grid.java"></script>
		Note that you could run the simulation on any grid, though it would most likely require a slightly more complex data structure.  You could even run it on arbitrary, irregular networks such as one formed from a <a href="http://en.wikipedia.org/wiki/Voronoi_diagram">voronoi diagram</a>.
		</div>
		<div class="title" id="opt">Optimization</div>
		<div class="text">
		Generally, complex simulations will take a lot of computation, and depending on what you want to do with them speed can be an important factor.  Therefore, optimizing your algorithm is often a necessary step.  It is not usually necessary to talk about low level optimization, such as reducing function calls or using fast bit level operations, but higher level algorithmic optimizations are important to understand.  
    <p>
    For instance, if you try to run the above grid-free code, essentially nothing with happen.  This is because odds are as a particle moves randomly, it will move away from the existing aggregation and never return.  So we want to make sure that the particle never moves too far away from the aggregation.  This is accomplished by defining a circle around the aggregation that the particle must lay in.  We can either have the particle wrap around when it hits the edge or have it "bounce" off.  The code below shows the particle wrapping around.
    <script src="http://gist.github.com/400005.js?file=dla_wrap.java"></script>
    Here we have defined a vector called dla_center for the center of the aggregation, and bound_radius which equals the the radius of the circle that defines the maximum distance allowed from the center.  It is necessary to keep track of the center of the aggregation and a radius which contains the aggregation as it grows.  Please note that there are a number of other approaches to this problem including having a boundary box, bouncing off the boundary, or simply restarting the circle in a random starting location.  The method shown is not necessarily optimal.
    <p>
    We can also increase the speed of the intersection part of the code.  Notice that each time we try to find an intersection, we go through every circle in the aggregation.  We call the time complexity of this function O(n), which means the number of operations grows linearly with number of circles.  This can be reduced using a space partitioning algorithm, which means instead of checking every circle, we only check those that we know are nearby.  This type of problem will come up in many different domains, and we will certainly come back to it in the future.  There are many techniques developed for these problems.  We will use the simplest in this case often called binning.  We divide space into a grid of a regular size such that if a circle is in one grid square, it can only intersect with circles in a neighboring grid square.  Because the number of possible neighboring circles is fixed, finding an intersection becomes a constant time function or O(1).
		</div>
		<div class="title" id="extend">Interactions and Extensions</div>
		<div class="text">
		Once you have a system, you have to figure out how you want to use it.  There are almost infinite directions you can take.  This is the aspect in which you most directly act as a "designer".  So what follows are merely some options of ways to interact with or develop the DLA system.
		<p>
		<img src="/media/images/visual_dla.jpg" style="width:500px;">
		We can identify some specific areas in the system we can explore to create variation.  The most direct and superficial is how we visualize the aggregation.  Often DLA patterns are drawn with the color of a particle corresponding to age.  This gives a visual sense of how the structure grows.  Another simple change is drawing the pattern as lines instead circles.  This requires keeping track of the structure of which particles are intersecting.  Other simple changes include varying the size of particles or extending the growth to more dimensions.
    <p>
    <div style="width:500px;height:255px;clear:both;">
    <div style="float:left;width:247px;margin-bottom:10px;font-size:8pt;text-align:center;" class="image">
    <img style="float:left;width:247px;" src="/media/images/dla8.gif">
    <div style="float:left;">p=0.2 image c/o Paul Bourke</div >
    </div>
    <div style="float:left;width:247px;margin-bottom:10px;font-size:8pt;" class="image">
    <img style="float:left;width:247px;height:247px;" src="/media/images/dla10.gif">
    p=0.01 image c/o Paul Bourke
    </div>
    </div>
    A property we can add to DLA is called stickiness.  Instead of always sticking when a particle intersects, particles stick with some probability.  By having a low probability, particles are able to slip past some of the exterior branching creating a denser pattern. 
    <p>
    We can also change the environment in which the particles grow.  The particles can stick to any initial starting surface.  We can also confine the growth into a certain space.
    <p>
    Finally, the most rich area of variation is changing the way particles move.  A simple directional force can be adding by making the particle tend in a certain direction as shown below.
    <script src="http://gist.github.com/400248.js?file=dla_force.java"></script>
    Going further, the particles can move in a force field.  In the example presented in <a href="http://toxiclibs.org/2010/02/new-package-simutils/">toxiclibs</a>, a force field is created along a guide curve, sculpting the growth along a specified path.  A force field could be created that responds to sound or video, so that the dynamics of the growth change through time.  More advanced work studies what is called dielectric breakdown modeling, which attempts to simulate when an insulator breaks down and a spark jumps.  In practice this is very similar to DLA except replacing the stochastic brownian motion with solving for the electric field, which is PDE formulation of the diffusion process.  In essence, you are solving for the probability that a particle will hit any part of aggregation.  In addition, you can manipulate the electric field by other means to effect or sculpt the growth.  Some of the links on this page show work in this domain.
		</div>
	<div class="title">Assignment</div>
	<div class="text">
	The first assignment is essentially to get start on your project.  As a guide to starting, I recommend finding phenomena, projects, and papers you are interested in.  You can use the <a href="inspiration.php">inspiration</a> page as a resource as well add things that you find to it.  Compile a set of images, text, techniques, etc. that can be a starting point for your project.  We can then discuss how you can approach the topics you have identified.
	</div>
	</div> <!-- first column -->
	<div class="rightColumn">
	<div class="lib">
	<div class="title"><a href="week2.php">Week 2 - Particles</a></div>
	<p>
	<span class="title">Links</span>
	<p>
	<a href="http://classes.yale.edu/fractals/panorama/physics/dla/dla.html">General info on DLA</a><br>
	<a href="http://www.andylomas.com/">DLA art by Andy Lomas</a><br>
	<a href="http://toxiclibs.org/2010/02/new-package-simutils/">toxiclibs simutils DLA simulation</a><br>
	<p>
	<span class="title">Papers</span>
	<p>
	<a href="papers/dla.pdf">An original paper describing DLA</a><br>
	<a href="http://gamma.cs.unc.edu/FRAC/laplacian_small.pdf">A graphics paper on a fast algorithm for Laplacian (DLA-like) growth</a><br>
	<a href="http://iahs.info/hsj/430/hysj_43_04_0549.pdf">Using DBM to model root development</a><br>
	<a href="http://prl.aps.org/abstract/PRL/v77/i11/p2328_1">Effect of Nutrient Diffusion and Flow on Coral Morphology</a><br>
	<a href="http://www.sciencedirect.com/science?_ob=ArticleURL&_udi=B6WMD-498TR0W-3&_user=10&_coverDate=09%2F21%2F2003&_rdoc=1&_fmt=high&_orig=search&_sort=d&_docanchor=&view=c&_searchStrId=1338061051&_rerunOrigin=scholar.google&_acct=C000050221&_version=1&_urlVersion=0&_userid=10&md5=17b070a09a05c32e82174fd61425355b">Models of coral growth: spontaneous branching, compactification and the Laplacian growth assumption</a><br>
	<p>
	<span class="title">Examples</a></span>
	<p>
	<a class="d" href="examples/week1.zip">Download All</a>
	<p>
	</div>	
	</div><!--end bod-->	
</body>
</html>