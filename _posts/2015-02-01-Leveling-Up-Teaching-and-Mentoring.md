---
layout: article
title: "Leveling Up: Teaching and Mentoring"
author: David Stockton
date:   2015-02-28 12:00:00 -0600
category: [php_architect, mentoring]
tags: [ php, learning, mentoring, teaching ]
---
# Leveling Up: Teaching and Mentoring
###### by David Stockton

> This column is about how to improve yourself. This could be how to improve as a developer, as a manager, as a person. This month, it's a little of everything, including how to improve yourself by helping others improve themselves and learn new skills. We'll be doing this by talking about teaching coding to others. Teaching is a powerful and rewarding method of improving your skills while  helping others.

## Introduction

It's commonly quoted, "He who can, does. He who cannot, teaches." Woody Allen expanded this with "Those who can't do, teach. Those who can't teach, teach gym." While funny and flippant (and extremely disrespectful to teachers), I completely disagree. It really ought to be "Those who can do, teach." Or if we can change the emphasis, "Those who can't do, teach and **learn to do**."

Teaching is a powerful way to level up your skills quickly and accurately. A study published in 2012 called "The Value of Bosses" found that on average, adding a tenth member to a team increased productivity by about 11 percent. But replacing a poor manager with a good manager increased productivity by 12 percent. The difference they found between the poor manager and the good manager was that the good manager taught. While they taught the people they supervised about the product and the company, they also taught them good habits and work skills. These new skills improved the productivity of the entire team.

There's a huge value in teaching. Not only at your job, but in your community (the PHP community, online community, where you live) and even in the schools near you. We'll get to each of these more on this in a bit.
 
## Teaching as a method of improving yourself

In order to teach, or rather in order to teach well, you must have a good understanding of the material yourself. You have to be able to succinctly and accurately describe new concepts and ideas. You have to be able to ask questions to help ascertain the level of understanding of those you are teaching and how to answer questions in a way that adds clarity and removes confusion.

From this point forward, I'll be using "students" to refer to whomever you are teaching, whether it is coworkers, conference or user group attendees, people on the internet or children. Understanding where your students are, conceptually, in learning these new concepts is critical in order to be able to effectively teach. This means you must improve your ability to learn, and study, and understand.

If you're in a management position already, part of your job is, or should be, helping the people you're supervising get better. This means mentoring and teaching. If you're not in management, find new cool things, learn about them, and teach your coworkers. In doing this, you are increasing your value to the team and your company as well as increasing the value of your coworkers to the company. People will remember and they will want to work with or for you. Again, more on this later.

## Teaching children

If you have children of your own, to a certain extent, you have a captive audience (age depending of course). If you are enthusiastic about the topic your kids will likely be interested and you can teach them. Since you're reading this magazine, there's a good chance you're a programmer or you're at the very least, interested in programming. Teaching your kids how to code is very rewarding. For those of you who have been coding for a while and not teaching, it will make you step back and not take anything for granted. Concepts you likely take for granted, like what an array or a variable is, will likely have no meaning at all to children until you help them understand.

At home, for the past few years, I've been working with my daughters on PHP, Python, JavaScript and Scratch. I might have started a little bit too soon with them (five and six years old) but now the fruit is starting to show. We began with the number guessing game. This is the game where the computer picks a random number and the player tries to guess what it is. The computer responds, telling the player if the guess was too high or low, and the player continues guessing until they get it correct. To build this, there's just a few concepts that are needed: basic understanding of variables, basic understanding of input and output (just use CLI), and the start of understanding of loops (looping until done) and conditionals (responding to the player if the guess high, low, or correct). 

Since I develop on a Mac, there's a command line application called "say" which will speak whatever phrase you give to it. With a small change to the program we created above, the code would now not only play the game with the kids, it would speak to them, telling them if their guesses were right or not. They loved this. I ended up typing nearly the entire program in, but I would make purposely make minor logic errors, or if I had a suggestion from my children that resulted in program behavior, I would code it as they suggested and then prompt them to figure out why the code didn't quite do what we wanted. At times, I could almost literally see the light bulb go on over their heads. Here, being able to ask prompting questions that gets them to the solution without outright telling them is a valuable skill. Watching them in this process was extremely rewarding. 

Building this code didn't take very long at all, so we quickly moved on to build the other side. In this program, the human player would pick a number, and the computer would guess. The player tells the computer if the guess was high or low. This adds a few new concepts, including the idea of algorithms. It is actually much easier to explain the concept of a binary search to a child than you may think. We also connected this program to the text-to-speech power of "say" and played a few games. My oldest daughter wondered if we could make the two programs play together, so that's what we did next. "Say" allows a `--voice` option to say things with different voices, so you could tell which player was speaking (the chooser or the guesser).

This was all a lot of fun, but we couldn't stop there, so we decided to make a way that we could have "voice files" which allowed us to create different personalities combined with different phrases that would be said at the various stages of the game. The process we followed would be very similar to one you might use for localizing your code for translation, but we made it so each voice file could have multiple ways to say the same thing and the code would randomly pick one of the options. We could set up any two of our voices and personalities to play against each other. There was the insulting voice of Zarvox, the alien, a little girl named Victoria as well as a variety of others. 

We also toyed with the idea of actually changing a bit about how the various computer players played. We thought about how we could make a player who could cheat (changing the number they picked or "listening" when the choosing player announced what the number was) or players who used different strategies than a binary search when guessing. We only talked about how we'd do this last part, but it was clear that the ideas were clicking.

From here both girls worked on (and are still working through) a book called Python for Kids and they both build a couple of new projects in Scratch almost every day. This interest they have developed for development has been very rewarding for me as their father so we decided to take it to the next level.

## Teaching kids at school

Last semester at my kids' school, I decided to get more involved and started a programming club. I meet with a group of elementary kids, ages eight to thirteen, and teach them how to write code in Javascript. Only one of the children had had any coding experience of any kind, so I got to start from scratch. This meant explaining concepts like variables, arrays, loops and conditionals.

For my part, while I knew a little about JavaScript, I definitely feel more comfortable in PHP, but I've been able to expand my knowledge of Javascript quite a lot. It's amazing what having a project or a purpose for learning will do for motivation and speed of picking up a topic. This learning was necessary in order to teach the kids how to make graphics show up in their browser. Since we were working on school lab computers, we're somewhat limited in what software was available. I figured that Chrome and notepad would be available, so that's what we started with.

Over the course of the semester we learned about how to create functions and use HTML5's canvas to draw squares on the screen. We used these squares as large "pixels" and built a simple library that allowed them to draw pixels on the screen in the color of their choice. From this, the kids have created their own pixel art using code, made randomly generated "grass blocks" in the style of MineCraft and created animated "dance floors".

Of course that was not the end goal. The pixel drawing library they created was then used to build a cellular automata called "Langton's Ant". In this code, we made a pixel (the "ant") move around the screen following a few simple instructions:

1. The ant travels around the screen. When it leaves a square, it changes the color of the square (white to black or vice versa).
2. If the ant enters a white square, turn 90° right, flip the square color, move forward one square.
3. If the ant enters a black square, turn 90° left, flip the square color, move forward one square.

From these simple rules, it appears that chaos happens but after a while, a repeating pattern emerges, looking like the ant creates a trail. I was able to use this exercise to introduce the chrome debugger, and get kids used to making mistakes (and trust me, a lot of mistakes will be made) in coding and how to find and solve the mistakes and fix the errors -- a critical skill for any developer.

With all of this in place, building Conway's game of life was almost trivial and we completed it in the last two hours of the semester. Watching a room of kids start to understand and experiment with code is invigorating, exciting, and rewarding and I've been able to improve how I approach Javascript code quite a bit. In many ways I feel like I've learned as much or more than these kids. The ability to really introspect code and determine what are the critical pieces that must be learned and understood in order to learn to code and what are the ideas that are important once you're a professional developer, but really don't matter yet to someone who is just learning, has been eye-opening. As professional developers, we know things like globals are bad, objects and encapsulation are good, coding styles are important, etc. 

For kids just starting out, much of that doesn't really matter: globals aren't going to kill them, and it means they can inspect things using the Chrome console. Consistent coding style isn't important, but in helping the kids, you may find that mentioning that being able to read the code and find where problems are is important, so at least some amount of style is useful.

For this semester, we're going to continue with what we learned and will be working on building our own version of the "Alchemy" game. This will involve quite a lot more in the way of HTML and CSS as well as some more advanced JavaScript concepts such as drag and drop, events, and objects. I'm really looking forward to how much I'll be able to learn by teaching these kids.

## Teaching coworkers

At work, unless you are a solo developer, you've probably got some fellow developers that you can teach and from whom you can learn. Assuming you're teaching fellow developers, you will might able to make a few assumptions that you cannot when you're teaching someone who doesn't know anything about development. The problems and solutions and technology will likely be a bit more advanced, but the principles remain the same. In order to effectively teach, especially something new, you need to learn it well enough to be able to explain and help them through initial pitfalls and questions that will inevitably happen.

At my current position, I find myself in a management role. I try to make sure the work environment is as learning friendly as possible. This is encouraged through "lunch and learns" where we get together and discuss something new to the group. More recently, we've been holding a weekly discussion group about Design Patterns and how they relate to our code and how they can be implemented in PHP. I feel that it has been very valuable and has increased the skills and the value of everyone who participates.

## Teaching at conferences and user groups

Expanding out from teaching at work, another opportunity to teach and share knowledge is to present at user groups and conferences. It's often humbling to find out how much research is necessary to be able to put together a presentation that will be delivered to other developers. Short of writing books, I'm not aware of another option for sharing information that will require so much research and work to make sure that whatever you're sharing is correct and accurate. 

Making sure developers learn things that are good and right was really the catalyst for getting involved in my local user group was a poor presentation. The presentation opened with tasteless, sexist jokes and continued with bad advice and insecure practices that beginning developers may not know are bad ideas. I decided that I did not want that to happen any more, at least as much as I could help, and so ended up taking over responsibility for running the group. Over the next four and half years, I was fortunate to share dozens of presentations, sit down with hundreds of developers, answer questions, teach, learn and grow. 

From speaking at user groups, you can work on expanding out and teaching at conferences. I've been fortunate enough to be able to do this and meet all sorts of community leaders from around the world. I cannot recommend speaking at user groups and conferences enough. There are so many people willing to help new speakers in the PHP community, it's amazing. If you find that you don't have a local user group, again, as they say, you're it. Start one.

## Sharing knowledge

So far, every method of teaching has been in person. It's also possible to teach and share information through the power of the internet. This can be in the form of screencasts on YouTube or any of a variety of paid services to services like Google Hangouts which make it possible to combine teaching people almost in person with a recording that allows interested learners to come back later and learn from you.

For a few months, I ran a weekly PHP study group online. I'd gather with 2-7 other developers and we'd talk, sometimes with a topic in mind, other times we'd learn about whatever came up. We did this all on Google Hangouts On Air which has the great feature of being able to both live broadcast on YouTube as well as immediately upload the end result so people who were not able to participate while it was happening can come back later and learn from the videos. Additionally, I've found that posting video recordings of presentations from user groups has been helpful for quite a few people.

By building up other people, you'll often find that they want to help build you up as well. I've been able to help people all over the world learn new things. 

## Mentoring

For a more intimate option, there's formal mentorship. In the PHP community, we have phpmentoring.org, a site that helps facilitate matching mentors and mentees. I would highly recommend checking it out. You can sign up with your areas of expertise or the topics you'd like to be able to mentor other developers. When you pair up with one or more other developers and work together to help them learn, you will find your own skills and understanding of these topics increases greatly and the relationships you develop can be very rewarding. 

Additionally, it is common for developers to mentor others on some topics while being mentored on other topics and areas. Feel free to sign up as both a mentor and a mentee and come join the conversation on Freenode IRC in #phpmentoring.

## Conclusion

Teaching and mentoring are some of the best ways I can think of to improve your skills, knowledge, and understanding of your craft. By spending time to teach and build up others, whether your own children, other kids, developers you work with, or developers at user groups, conferences, on the internet or in the community, you'll find that your own understanding will increase, your value to your team will grow, your visibility and value with your company and the community will grow, and your career can be advanced by leaps and bounds. So go forth, teach, share your knowledge, and grow and see the rewards come in.

> ### Biography
> David Stockton is a husband, father and Software Developer. He is VP of Technology at i3logix in Colorado leading a few teams of software developers building a very diverse array of applications. He has two daughters, 10 and 9, who are learning to code in a variety of languages and build circuits and a 3 year old son who has been seen studying calculus and recursive algorithms. David is an active proponent of TDDs, APIs and elegant PHP.