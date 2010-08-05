<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Nervous System | Simulation and Nature in Design</title>
<?php require('../include/header.php'); ?>


	<div class="leftColumn">
	    <div class="title">
	    Multi-agent Systems
	    </div>
	    <img src="/media/images/flocking.jpg">
	    <div class="text">
	    Multi-agent modeling is a general framework for thinking about systems of individuals.  It is in fact so general that it is difficult to define exactly what it is.  One sense in which we can think about multi-agent systems are as particle systems, but instead of modeling physics, they have completely arbitrary rules and states.  So instead of acting based on forces, there is a set of rules that governs the motion/actions of each particle/individual.  This is useful when thinking about swarms, crowds, and populations that are moving.  However, not all agent-based necessarily involve motion.  Some involve dynamics on networks or do not involve any sense of space.  Another way to think about agents is through the idea of utility.  Each agent has a utility function which it is trying to maximize and it also has rules about how it can change states to increase its utility.
	    <p>
	    We will primarily be talking about agents in the framework of moving particles.   Because agents are so general, almost anything can be described as a multi-agent system.  As such the study of multi-agent systems is most relavent in fields where precise descriptions are difficult.  Agents are a common approach to modeling problems in behavioral economics and ecology.  These domains involve the interaction of a large number of individuals who may having varying roles or properties as well as complex environmental conditions.  These problems are difficult or impossible to describe in a precise mathematical formulation.  Agents are also often used in computer graphics to allow the animation of crowds without directly controling each character.
	    </div>
	    <div class="title">Flocking and Boids</div>
	    <object width="640" height="385"><param name="movie" value="http://www.youtube.com/v/qAWeso1j0ok&hl=en_US&fs=1&"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/qAWeso1j0ok&hl=en_US&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="640" height="385"></embed></object>
      <div class="text">
	    A common problem in multi-agent systems is simulating the motion of groups.  These could be crowds, flocks of birds, schools of fish, or traffic.  One of the earliest examples of these models was a simulation of flocking called Boids, created by Craig Reynolds.
        <p>
        The idea of the model is that each agent wants to be a certain distance from its neighbors and it also wants to go in the same direction as its neighbors.  We define a set of rules or behaviors that govern each agent so that it will work towards that condition.  In the simplest boid implementation there are three rules:<br>
        <div style="padding-top:5px;float:left;text-align:center;font-size:8pt;">images c/o Craig Reynolds<br><a href="http://www.red3d.com/cwr/boids">
        <div style="float:left;"><img src="/media/images/http://www.red3d.com/cwr/boids/separation.gif" style="width:160px;"><br>separation</div>
         <div style="float:left;"><img src="/media/images/http://www.red3d.com/cwr/boids/alignment.gif" style="width:160px;"><br>alignment</div>
        <div style="float:left;"><img src="/media/images/http://www.red3d.com/cwr/boids/cohesion.gif" style="width:160px;"><br>cohesion</div><br></a>
        
        </div>
        <p>
        <br><br>
        Cohesion. The desire to be in a group or attract to other agents.  We model this as moving toward the centriod of the local neighborhood.  We could think of this as a force towards average of the neighborhood.<br>  
       <img src="/media/images/cohesion_equation.png" class="equation"><br>
	<p>
        Alignment.  Each agent wants to fly in the same direction as its neighbors.  We want the velocity to tend to be the same between neighboring agents.
       <img src="/media/images/alignment_equation.png" class="equation"><br>
        <p>
        Separation.  Agents don't like to be too close to each other.  If agents are within a certain distance of each other, they repel.<br>
       <img src="/media/images/separation_equation.png" class="equation"><br>
        <p>
        The other important component is the neighborhood.  In the simplest case, every agent within a certain radius is a neighbor.  However, in reality many agents cannot see behind them.  So we can also define the neighborhood as with a distance and an angle.  Every agent within the area swept out by a line going from straightword (determined by velocity) and rotate by some angle is in the neighborhood.  This can easily be determined by measuring the angle between the velocity vector and the vector from the current agent to a potential neighbor.
        <p>
        We may even want different rules to have different neighborhoods.  An agent is only interested in avoiding agents that are very close and only interested in follow agents that are in front of them. 
        <p>
        In order to quickly find the neighborhood, we need a fast way to find agents within a certain radius.  We can use a simple binning data structure, as we have used in the past.  There are also more complex collision detection algorithms which can account for unbounded spaces and variable radii.
        <p>
        We can think about these different behaviors as forces, where cohesion would mean the agent is attracted to the centroid of the neighborhood, or we can think of them in terms of "steering".  This means we think of our agent like a vehicle, which if it wants to go towards something it turns or steers towards it.  So primarily what we are changing is direction, not magnitude.  If we are already going towards the center, we do not need to accelerate towards it.  This entails taking the desired velocity, subtracting the current velocity, and using that as your acceleration.
</p>
	    </div>
	    <div class="title">Behaviors</div>
<div class="text">
<p>
Largely because 'multiagent simulation' is such an [over]broad term,
there are lots of exntesions and refinements that people explore.
</p>
<p>
One way to think about how the field is organized is by looking at
which piece of the generic multiagent model you're tweaking:
<ul>
<li> <span style="font-family:bold">agents</span> :: Do they change over time?  Can they talk to one another?
  Do they all follow the same rules at the same time?  Are their rules
  spatially dependent?
</li>
<li> <span style="font-family:bold">environment</span> :: Does the environment change over time?  Is it
  affected by different agents differently?  Or does it only affect
  agents?  What sort of information does it give to the agents?
</li>
</p>
<p>
For a reasonably clear overview of the strategies and ideas that the
multiagent community has developed, check out
Shoham's <a href="papers/MULTIAGENT_SYSTEMS.pdf"><span class="font-style:italic">Multiagent
System</span></a> textbook for a pretty comprehensive survey of the
issues we'll touch on here.
</p> 

<p>
<h3>agent-agent interactions</h3>
In exploring how to modify and extend agent-agent interactions, it can
be helpful to think about what the agents are doing in terms of
message-passing.  From this angle, there are four dimensions of
agent-agent behavior you can think about: 
<ul>
<li>what sorts/species of agents are there</li>
<li>the messages agents pass</li>
<li>the way agents' behavior can change, and</li>
<li>what determines to whom the agents can pass messages</li>
</ul>
</p>
<p>
The first dimension is the most obvious: can you have more than one
type of agent?  Plenty of multiagent systems (e.g. flocking) stick
with a single species and still create interesting, large scale
behavior.  There are a lot of systems which call for different groups
or species of agents: simulation of predator and prey interactions on
a scale, exploration of voting patterns and behavior, and modeling of
urban environments involving a mix of different vehicles and
pedestrians (sometimes getting as finely grained as accounting for
children and elderly people's different modes of motion).
</p>
<p>
With the species of agent in mind, it's worth asking what sort of
messages agents can pass around.  In examples like flocking, agents
communicate with one another simply by being near to one another.  You
can start to extend this by making it possible for agents to look at
other characteristics of their neighbors, like speed, acceleration,
and direction, and having the agents respond in some way.
</p>
<p>
What way?  The range of possible agent behaviors is another dimension along
which people extend and play with multiagent systems.  What can your
agents do?  Do they leave a trail?  Do they just move around?  Can
they get more massive?  Change shape?  Do they reproduce?
</p>
<p>
The last piece of local interactions that you want to keep in mind as
you look at how people are modeling multiagent systems is the agent's
"neighborhood."  These dimensions all get subtler as your agents get
more sophisticated&mdash;for an introduction to some of the tactics
used in simulating people and crowds in the multiagent paradigm, take
a look
at <a href="papers/Scalable_behaviors_for_crowd_simulation.pdf">"Scalable
behaviors for crowd simulation"</a>.
</p>

<p>
<h4>a high level example</h4>

Ecology is one field that has found a lot of applications for
multiagent simulation.  People have done everything from reproduce
pack hunting behaviors to simulate the population dynamics of predator
and prey in a complex food web.
</p>
<p>
Let's take a look at the predator-prey question.  In the wild, you
have bunches of different species of plants and animals.  Everyone
wants to eat someone, and most everyone wants to avoid being eaten by
someone else.  Starting in the simplest case, a predator-prey
multiagent system is a 2-agent system seeded in a big, flat plane,
randomly.  At a first pass, you might make the bunnies and wolves move
around randomly, and whenever they ran into each other, the bunnies
would die.  The bunnies and wolves could start out by moving randomly,
or by diffusing, or you could introduce pursuit and evasion behavior,
and eventually add things like reproduction and natural&mdash;well,
not wolf-induced&mdash;death.

Going beyond this, there are&mdash;as is often the case with
multiagent simulations&mdash;an enormous number of refinements you can
make.  The goal to keep in mind is the behavior you're after.  An
accurate model is different than an effective one.  Some possible
extensions include:
<ul> 
<li> lifespan (meaning you'd want to have some way of keeping track of
  how long each agent was alive)</li>

<li>changing speed with age (meaning each agent would need some
  parameter that individually controlled their speed)</li>

<li>flocking behavior within bunny families (meaning each agent would
  need some way of recognizing and locating their family
  members&mdash;perhaps agents can ask for a 'name' from everyone they see)</li>

<li>reproduction (meaning every time a boy bunny meets a girl bunny,
    there's some probability another bunny pops up)</li>

<li>pursuit and evasion (meaning bunnies and wolves would not only
need to be able to find nearby bunnies and wolves, but figure out in
what direction their neighbors were moving)</li>
</ul>
</p>


<p>
<h3>agent-environment interactions</h3> A lot of the questions people
ask with multiagent systems move beyond just agents talking to one
another (as in flocking) and start to put their agents in environments
that change in space and time.  In our predator-prey example, that
might mean anything animals' top speeds changes from area to area.
Or, it could mean that it becomes less likely for a wolf to notice a
bunny if the bunny is in a specific area (that we might be imagining
as "underbrush").  But, environments can do more than just affect the
behavior of agents&mdash; can affect environments, as well.
</p>
<p>
In the ecological domain, lots of multiagent simulations have agents
affect the environment by consuming resources or altering landscape to
start to get at ideas of "carrying capacity."  To return to our
predator and prey example, your wolves and bunnies could be moving on
a grid where each square contains an amount of some resource
(e.g. grass) that is consumed by the bunnies as they travel through it
and is replenished at some rate.  Seeding the initial stage with
different distributions of grass will create different long term
behavior in terms of where the bunnies aggregate and grow.
</p>
<p>
Another common extension of agent-environment interactions is for
agents to leave trails (which may decay with time) that either
influence other agents (as in the case of ants that follow one
another's pheromones) or alter the environment.  Implementing this
starts with some way for agents to record where they have
been&mdash;this might mean changing the color of a pixel or storing
more complicated information in a matrix that other agents refer to as
they travel from point to point.  To get some sense for how people
implement these extensions&mdash;and what sorts of behaviors they can
create&mdash;check
out <a href="papers/Complex_Emergent_Behaviour_from_Spatial_Animat_Agents.pdf">Hawick's
"Complex Emergent Behaviour from Spatial Animat Agents"</a> and try to
ignore the ridiculously liberal sprinkling of buzzwords.
</p>


<p>
<h3>extending and evolving agents and environment</h3> There are lots
of ways that people extend the capability of agents in multiagent
simulations.  People throw in evolution of specific traits, they
create languages that the agents can use to pass more and more
sophisticated messages, and they do things like give agents memory (so
in the predator prey example, people have created systems where
individual predator and prey evolve different strategies for pursuit
and evasion, and the wolves and bunnies can essentially do things like
"rememember" that a particular bunny is likely to dodge right if you
run straight in, etc.)  We're going to focus on techniques for
evolving agents, but if you're interested in the AI/learning side of
multiagent learning, check out the review articles, "Cooperative
Multi-Agent Learning: The State of the Art" (which covers a handful of
ways in which agents evolve and are extended in multiagent
simulations).
</p>

<p>
One of the most general and useful techniques for evolving agents is
genetic algorithms.  The overall idea of genetic algorithms is
inspired by evolution.  In nature, new genomes appear either through
mutation or through two individuals mating, and this creates a unique
individual that tries to make its way in the world, surviving long
enough to reproduce.  
</p>
<p>
Genetic algorithms generalize this process.  The basic idea is that
you encode everything which interests you about an agent into a
"genome."  You then let your agent make its way in your virtual world,
and based on some definition of "fitness" or "quality" or "utility"
you select some of your population, take their genomes, and mix them
up a bit, creating a new generation.  Rinsing and repeating, over time
your agents "evolve."
</p>
<p>
This description waves off a lot of the details, so lets look a little
closer at a specific example that returns to our predator-prey model.
</p>

<p>
<h4>a high level example</h4>
This example is drawn
from <a href="http://vodpod.com/watch/268558-ted-talks-theo-jansen-the-art-of-creating-creatures-video">Theo
Jansen</a>'s work, a Dutch artist and kinetic sculptor famous for his
mechanical beach beasts made from plastic tubing.
</p>
<p>
One of his earliest explorations in creature creations was entirely
digital.  His agents were small animals shaped like lines that flew
around, bounced off walls, and killed each other when they ran into
another one.  So even simpler than a two-agent, predator-prey system,
it was a one-agent system where everyone is a predator and a prey.
</p>
<p>But looking at the digital representation of these animals, they
were broken up into four segments, each of which could be straight,
curved clockwise, or curved counterclockwise.  Each generation,
surviving animals would get copied, but there was some probability of
a mutation.  If an animal started out straight, there was some
likelihood that its child would have a kink.
</p>
<p>
Over time, he found that the population evolved toward being totally
curled up: minimizing their cross sectional area, and thus minimizing
the probability that they'd be stabbed by another animal.
</p>
<p>
You're already familiar with what it takes to make the animals move
around, and to detect when they run into each other (and thus die).
But how to achieve the evolutionary piece?
</p>
<p>
The first step is to figure out how to encode the properties of the
creature.  In this case, one way to do it would be to choose a number
to represent a straight, clockwise, and counterclockwise segment.  In
this case, the "genome" for each animal could simply be four numbers.
So, lets say we chose -1 to be counterclockwise curved, 0 straight,
and 1 clockwise curved.  0000 would be a straight animal, 1111 a
totally curved one, and 010-1 some mix.
</p>
<p>
Each generation, we could make copies of say one out of every ten of
the animals, and maybe one out of every ten of those would not get
copied exactly, but would get one of their segments assigned randomly.
</p>
<p>
A few minutes later, after they bounce around for a while, killing
each other off, the cycle repeats.
</p>

<p>
For some images from Jansen's original work, check out <a href="papers/jansen.html">this excerpt</a> from his book, <a href="http://www.amazon.com/Theo-Jansen-Great-Pretender/dp/9064506302/ref=sr_1_2?ie=UTF8&s=books&qid=1276715701&sr=1-2"><span style="font-style:italic">The Great Pretender</span></a>.  For more in-depth explanations of the basic process behind creating genetic algorithms, check out <a href="http://www.obitko.com/tutorials/genetic-algorithms/">this tutorial</a>.
</p>
</div>
	   
<div class="title">Suggested Problems</div>
<div class="text">
<ul id="suggested-problems">
<li>Try creating a multiagent simulation with more than one type of
agent.  Have those agents interact with trails left by other
agents.</li>
  
<li>Try implementing and extending Jansen's simulation to allow the
  animals to grow in each generation.</li>

<li>Take a look
at <a href="http://ccl.northwestern.edu/netlogo/">NetLogo</a>&mdash;a
multi-agent programmable modeling environment&mdash;for some inspiration of systems to model, as well as examples of how people implement a lot of these strategies.  Note that NetLogo has its own language, but it's pretty high level, and <a href="http://online.sfsu.edu/~jjohnson/NetlogoTranslation/NetLogoTranslationWelcome.htm">this tutorial</a> should get you started.

</ul> <!--ends ul#suggested-problems -->
</div>
	    
	</div> <!-- first column -->
	<div class="rightColumn">
	<div class="lib">
  <div class="title"><a href="week3.php">Week 3 - Finite Difference and Diffusion</a></div>
	<div class="title"><a href="week5.php">Week 5 - Smoothed Particles and Fluids</a></div>
	
	<div class="title">Links</a></div>
	<p>
	<a href="http://www.red3d.com/cwr/boids/">Craig Reynolds' Page on Boids</a><br>
	<a href="http://www.shiffman.net/teaching/nature/steering/">Daniel Shiffman's Tutorial on Steering Behaviors</a><br>
	<a href="papers/Complex_Emergent_Behaviour_from_Spatial_Animat_Agents.pdf">"Complex Emergent Behaviour from Spatial Animat Agents"</a>
	<a href="papers/Cooperative_Multi-Agent_Learning:_The_State_of_the_Art.pdf">"Cooperative Multi-Agent Learning: The State of the Art"</a>
	<a href="papers/Scalable_behaviors_for_crowd_simulation.pdf">"Scalable behaviors for crowd simulation"</a>
	<a href="papers/MULTIAGENT_SYSTEMS.pdf"</a><span style="font-style:italic">Multiagent Systems - Algorithmic, Game Theoretic, and Logical Foundations</span></a>
	   <a href="http://www.ted.com/talks/theo_jansen_creates_new_creatures.html">"Theo Jansen - The Art of Creating Creatures (TED Talk)"</a>
	<div class="title">Examples</a></div>
	<p>
	<!--<a class="d" href=/media/images//media/images/"">Download All</a>-->
	<p>
	<a href="examples/boids.zip">Class boids examples</a>



       
	</div>
	</div>	
	</div><!--end bod-->	
</body>
</html>
