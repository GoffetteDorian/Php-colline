# The Hill - 02 - BCBB

> PHP/MySQL Bulletin Board Project

* * *

## Part one - basics

In this project, you will create a _bulletin board_, also called _forum_, using `PHP` & `MySQL`.  
You will also use `SASS` & `Bootstrap`.  
The tooling will use `docker`.

### Features

You will design a database to handle four types of data:

- users
- boards
- topics
- messages

#### Users

Users must be _connected_ to interact ; you will need to implement the creation of users (_sign up_) and the connection of users (_sign in_). Users will use an _unique_ `email` and a `password` for authorization.

Users will also have a _nickname_ (must be unique), an _avatar_ (use [Gravatar](//gravatar.com)) and a _signature_ (to show at the end of each users' messages).

Users will be able to modify their information (except email) on a **profile page**.

#### Boards

A Board is a logical group of Topics. There will be four boards in your database: **General**, **Development**, **Smalltalk** and **Events**.

Each Board has a _name_ and a _description_.

When showing the list of the Boards, you need to show the last Topics: the three one with the most recent Message.

#### Topics

A Topic is a timeline of Messages. 

Every user can create a Topic in a Board.

Each Topic has a _title_, a _creation date_, a _content_ (which is kinda the _first message_) and an _author_ (an User).

#### Messages

A Message is a contribution from an User to a Topic.

Every User can add a Message to a Topic.

Each Message has a _content_, a _create date_, an _author_ (an User), and an _edition date_.

The _content_ must be _rich_: it must interprets **markdown** and shows **emojis**.

A Message can be _edited_ by his author, and will show his _edition date_ in that case.

A Message can be _deleted_ by his author, and will be shown as "deleted" in the Topic.

### Technical aspects

You will work by teams of 3 (or 4).

#### Tooling

To handle your _local environment_, you will use **docker** and **docker-compose**. Please refer to the [docker-readme.md](./docker-readme.md) file to know how to install and use docker.

> 🖐 **docker** is a quite complex tool. We will take some time at the beginning of the project to explain you what it is and why we decide to use it.

Whitin your docker environment, you have an instance of **phpMyAdmin**, a _database manager_, to help you interact with your database while working on your project.

#### Organization & workflow

Be sure to document everything, that _anyone_ on the team can explain and understand _every_ part of the project.

Communication is the key.

> 👉 Remember that there will be two parts on this project : you will need to continue working on it for a second time

### Deployment & deadline

The project needs to be _published_ on [Heroku](//heroku.com) (you have free credits to use on Heroku with your **GitHub Student Pack**).

At the deadline of _TODO_, we need to receive an **email**, to `leny@becode.org` **and** `julie@becode.org`, with the _URL of your repository_ and the _URL of your project_ on Heroku.