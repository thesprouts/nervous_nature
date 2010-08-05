<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Nervous System | Simulation and Nature in Design</title>
<?php require('../include/header.php'); ?>


	<div class="leftColumn">
	    <div class="title">
	    Dunes
	    </div>
	    <img src="/media/images/dunes.jpg"><br>
<div class="title" id="overview-of-windsand-dynamics"
>overview of wind/sand dynamics</div>
<div class="text">
Up till this point, many of our simulations have been based on "first principles."  By this I mean, we take a fundamental idea about how nature works, like conservation of momentum, encode it in an equation, and try to solve that equation numerically.  For wind-blown sand, the fundamental principles involved are quite complex (fluids, particles transport, particles colliding).
<p>
Often, the biggest choice someone makes in developing a model is about their expectation of how much detail is required to recapitulate the dynamics they&rsquo;re interested.</p>
<p>For example: although we have a descriptions of the physical world which are incredibly accurate (e.g. quantum mechanics), it very rarely makes sense to start from there in developing a model. The questions of what a &rsquo;successful&rsquo; model entails (is it qualitative similarity? Do you have some quantitative standard?) and what dynamics you expect you will need to explicitly encode to recreate that phenomena are central to understanding the various approaches people take.
</p>
<p>In looking at windblown particles, one family of approaches assumes that we can largely ignore the detailed physics of what is going on, and that what&rsquo;s important is to understand the effects in aggregate. i.e. &ldquo;Net, sand is moving away from this patch and into this other patch.&rdquo; At the other end of the spectrum, there are modes which try to simulate every aspect of the environment in detail. For example, these models might model the detailed flow and turbulence of wind, the interaction between the wind and the sand, etc.</p>
<p>Along similar lines, when simulating complex phenomena, there are often aspects which appear to be essentially random. Some approaches to modeling these phenomena embrace this randomness and simulate particle-level dynamics which incorporate a random component. These are known as <strong>stochastic</strong> models.  An alternative is to look at the particles in aggregate and focus on the trends that persist independent of that randomness. For example, one approach to simulating diffusion is to make each particle take a random walk, &ldquo;Brownian motion.&rdquo; But, you can also zoom out and think of diffusion as an aggregate process of many random walks that tends to move from regions of high concentration to regions of low concentration.
</p>
<img style="width:500px;" src="/media/images/reptation.PNG"><br>
<p>When describing dune formation (aka Aeolian processes<a href="#fn1" class="footnoteRef" id="fnref1"><sup>1</sup></a>), people typically abstract out much of the complex behavior involved (fluid motion, wind carrying particles, collisions).  Instead they refer to four different processes:</p><ul><li>
  <strong>saltation</strong> :: or less jargonly: particles jumping (in the case of desert dunes, <span class="math">&#8201;&#8776;&#8201;10\textrm{<em
	>cm</em
	>}</span>) by getting kicked up by the wind. In other words, the wind blows by some sand, and occasionally, it picks up the sand and throws it some distance away.
  </li><li><strong>creep</strong> :: particles rolling around, but never leaving the ground, due to wind and/or gravity. So for example, when the ground is flat and wind is blowing over it, particles move and slide around on top of one another, even if they aren&rsquo;t lifted into the air.</li><li><p><strong>suspension</strong> :: particles which get carried into the air for a significant period of time (multiple timesteps).</p></li><li><p
    ><strong
      >reptation</strong
      > :: or less jargonly: when grains of sand which have been lifted into the air impact other grains of sand and cause them to kick up and splash small distances. These tend to travel a much shorter distance than particles which are &ldquo;saltating.&rdquo;</p>
      </li></ul>
<img style="width:300px;" src="/media/images/dune_phasediagram_hack.png"><br>
</div><div class="title" id="nishimori-and-tanaka--simple-model-for-the-complex-dynamics-of-dunes">nishimori and tanaka :: &ldquo;simple model for the complex dynamics of dunes&rdquo;</div>
<div class="text">
People have been working for a long time to develop a model which recreates the various qualitative and quantitative aspects of dunes. This is hard in part because there are tons of different types of dunes and sand ripples and a number of different conditions under which they develop (e.g. behind plants<a href="#fn2" class="footnoteRef" id="fnref2"
  ><sup
    >2</sup
    ></a
  >).
  <p>Nishimori and Tanaka created a simple model of dune formation which recreates the qualitative behavior of different types of sand dunes that people have observed over the years. A nice visual summary of this is Hack&rsquo;s phase diagram<a href="#fn3" class="footnoteRef" id="fnref3"
  ><sup
    >3</sup
    ></a
  ></p
><p
></p
><p
>This model tries to simplify the simulation by looking at the mass behavior of sand particles, instead of thinking about each, individual one. For them, dune formation is the result of primarily two processes:</p
><ul
><li
  ><p
    ><strong
      >inertial</strong
      > or <strong
      >advection</strong
      > process :: the mass effect of particles jumping around (saltating) due to wind.</p
    ></li
  ><li
  ><p
    ><strong
      >frictional</strong
      > or <strong
      >diffusion</strong
      > process :: essentially, random motion of sand particles due to the fact that the natural world is very rarely perfect&mdash;dune surface irregularities, erratic wind, etc.</p
    ></li
  ></ul
><p
>Nishimori and Tanaka&rsquo;s approach starts with a big grid (&ldquo;lattice&rdquo;) of cells. Each cell in the <span class="math"
  ><em
    >i</em
    ></span
  >th row and <span class="math"
  ><em
    >j</em
    ></span
  >th column has a height <span class="math"
  ><em
    >h</em
    >(<em
    >i</em
    >,<em
    >j</em
    >)</span
  >. Each time step, the various heights of the cells change as sand moves between them. The cells are big enough such that the height change indicates the net movement of sand, not the movement of individual grains.</p
><p
>At each time step, sand moves out of each cell depending on how strong the wind is, where it is blowing, what the local slope of the sand is, and what the local slope is <em
  >in the direction of the wind</em
  >.</p
><p
>The local slope affects how likely sand is to roll downhill&mdash;the &ldquo;frictional&rdquo; process is essentially random motion which is weighted by the slope of the surface (so, even though the sand is moving randomly, it is more likely to move in the direction that the sand is sloping).</p
><p
>The slope of the sand in the direction of wind is the the central piece which creates the &ldquo;inertial&rdquo; or &ldquo;advection&rdquo; behavior. People have observed that on the windward side of sand hills (i.e. the side facing the wind), the wind velocity is much higher than on the lee side (the side facing away from the wind). This is largely because the wind running into the hill gets compressed and pushed up the side of the hill, whereas on the lee side, it spills over the top and is shielded from the wind &ldquo;behind&rdquo; the hill.</p
><p
>Part of the simplicity of this model comes from the fact that they explicitly ignore the complex dynamics of individual sand particles. The amount a sand particle jumps by is very sensitive to the shape of the sand (which is in turn determined by the amount sand particles move when carried by the wind). Despite this, by talking about the behavior of many sand particles in aggregate, our job gets a lot easier.</p>
<p>In particular, to accommodate Rasmussen&rsquo;s observations of how local slope of the sand (<em>in the direction of the wind</em>) affects wind speed, they choose to make the amount a particle jumps (saltates) by (also known as the &ldquo;transport length&rdquo;) and the amount removed from each cell (the &ldquo;height transfer&rdquo;) depend on <span class="math">tanh</span> of the slope. <span class="math">tanh</span> is short for &ldquo;hyperbolic tangent,&rdquo; and the choice to use it was kind of arbitrary: we need a function which increased nonlinearly and plateaued at a low number above zero, and decreased and plateaued nonlinearly and plateaued at a low number below zero. <span class="math"
  >tanh</span
  > does this.</p
><p
>
<img src="/media/images/tanh.png"><br>
</p
><p
><em
  >Why</em
  > the relationship between windspeed and slow is nonlinear (and in particular, why the nonlinearity of <span class="math"
  >tanh</span
  > is a reasonable approximation) has partly to do with the compressibility of air and some facts from fluid dynamics.
  
  </p></div><div class="title" id="extending-and-refining"
>extending and refining</div><div class="text">There are a number of ways to refine and extend Nishimori and Tanaka&rsquo;s model by taking into account other behaviors of sand we know about. Something to keep in mind is that our model focuses on modeling sand <em
  >in aggregate</em
  >, so it may be easy to come up with many more refinements which may not necessarily affect the large scale behavior of the system. For example, introducing a model of turbulence is unlikely to change the large scale behavior if in effect, it is simply introducing more randomness or noise to the diffusion step. On the other hand, if you get patterned turbulence (e.g. persistent vortices), you could imagine this dramatically changing the behavior of the system.
<p>Much of the point of this &ldquo;minimal model&rdquo; is that our finely-grained physics-driven understanding can sometimes make it hard to see the forest for the trees.</p
>
</div><div class="title" id="critical-angle-of-repose"
>critical angle of repose</div>
<div class="text">In short, the critical angle of repose is the steepest angle a pile of granular material can make. You may have noticed that piling loose, dry sand results in a much flatter mound than wet sand&mdash;at some point, the angle becomes too steep (and the effect of gravity too great) for the sand to avoid rolling down and falling. The size, shape, and wetness of the sand control where this critical angle is
<p>Usually, this critical angle is between <span class="math"
  >15 deg</span
  >&ndash;<span class="math">30 deg</span>. Incorporating it into our model of dune formation would involve adjusting our weighting of the frictional process by slope to be more nonlinear&mdash;rather than have it simply increase with slope, we&rsquo;d like it to increase nonlinearly and reach a point where at the angle of repose, sand will <em>definitely</em> roll.</p>
  </div><div class="text"
><hr
   /><ol
  ><li id="fn1"
    ><p
      >in jargon, &ldquo;aeolian processes&rdquo;&mdash;Aeolus was the keeper of the winds in Greek mythology. <a href="#fnref1" class="footnoteBackLink" title="Jump back to footnote 1">&#8617;</a></p
      ></li
    ><li id="fn2"
    ><p
      >or in jargon, &quot;vegetated dunes&quot; <a href="#fnref2" class="footnoteBackLink" title="Jump back to footnote 2">&#8617;</a></p
      ></li
    ><li id="fn3"
    ><p>A phase diagram is just a diagram which tells you how something depends on a variety of variables at every point. The language comes from diagrams which illustrate the dependence of the phase of a material (liquid, gas, solid) on temperature and pressure. In Hack&rsquo;s case, the axes are vegetation, wind, and supply of sand. <a href="#fnref3" class="footnoteBackLink" title="Jump back to footnote 3">&#8617;</a></p></li></ol>
    </div>

	</div> <!-- first column -->
	<div class="rightColumn">
	<div class="lib">
  <div class="title"><a href="week6.php">Week 6 - SPH continued</a></div>
	<div class="title"><a href="week8.php">Week 8 - Graphics, Curves, and Surfaces</a></div>

	
	<div class="title">Links</div>
	<a href="papers/dunes/Simple Model for the Complex Dynamics of Dunes.pdf">A simple model for dune formation by Nishimori and Tanaka</a> - This is the basis for our simulation</a><br>
	<a href="papers/wind_ripples2.pdf">A slightly more complex (but similar) model of dune formation</a><br>
	<a href="papers/dunes/dune_wind.pdf">A stochastic simulation of small scale sand ripples</a> - Looks primarily at reptation.<br>
	<a href="papers/dunes/Mechanics_of_wind-blown_sand_movements.pdf">Mechanics of Wind-Blown Sand Movements</a> - A book on this topic<br>
	<p>
	<div class="title">Examples</div>
	<p>
	<a class="d" href="examples/dunes_nishi_bare.zip">Bare bones dune simulation</a>
	<a class="d" href="examples/dunes_nishi_commented.zip">Nishimori simulation with 3D terrain and some additions (NOW WITH COMMENTS!)</a>
	<p>


       
	</div>
	</div>	
	</div><!--end bod-->	
</body>
</html>
