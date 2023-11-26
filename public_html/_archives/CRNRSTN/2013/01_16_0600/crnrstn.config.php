<?php

## LEGAL NOTICE ::
## In honor of King Abdullah Bin Abdul Aziz's bold move to provide 500 tons of wheat to the Syrian refugees (as reported by Al Arabiya on http://english.alarabiya.net/articles/2013/01/13/260276.html),
## as of today (1/16/2013 @ 0600), I am undertaking a slightly less noble...but just as sincere...effort to create a business enterprise level PHP class library to give to the people.
## This body of code is completely new, and I am only leveraging resources and knowledge as is readily and freely provided by the open source PHP community for the benefit of exactly the same.
## No part of any application that I developed whilst under the employ of an agency or for-profit business entity has been lifted and placed into this work.
## Being that I am currently being subjected to extensive government surveillance protocols, the genesis of this project has been recorded and documented. There are witnesses who can vouch for this work 
## as per the above.
## # # # # # # # # # # # # # # # # # # # # 

## # # # # # # # # # # # # # # # # # # # # 
## Cornerstone ::
## An open source PHP class library supporting enterprise application development that is framed within the context of mature/rigid RTM protocols.
## Copyright (C) 2013 Jonathan 'J5' Harris
## 
## This program is free software: you can redistribute it and/or modify
## it under the terms of version 3 of the GNU Lesser General Public License which incorporates
## the terms and conditions  of the GNU General Public License and is supplemented by 
## additional permissions. These additional permissions are listed in full in 
## the crnrstn.license.txt file that should have accompanied this software distribution.
## 
## You are also free to apply the terms of the current GNU Lesser General Public License 
## which is published by the Free Software Foundation...that is...either version 3 of 
## the License, or (at your option) any later version.
## 
## This program is distributed in the hope that it will be useful,
## but WITHOUT ANY WARRANTY; without even the implied warranty of
## MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
## GNU Lesser General Public License for more details.
## 
## As stated above, you should have received a copy of the GNU Lesser General Public License
## along with this program.  If not, see <http://www.gnu.org/licenses/>
## 
## Original copies of this software distribution can be obtained from http://jony5.com/crnrstn
## Feel free to contact me at http://jony5.com/contact/ and I'll get back to you at my earliest convenience.
## # # # # # # # # # # # # # # # # # # # # 


## This file is the jump off point for the iterative life cycle development of this software.
## SHIT BEGINS HERE ##


/* 
1/16 ::
Must answer the question 'Who am I' before you can know what you do. 
- The simple question begs for a simple solution. Complicated switches are rigid (read this as option limiting) and probably unnecessary.
- To flexibly support [n] cases means abstract environmentally specific parameters to environmentally specific profile file. Think one-to-one relation.
- Aggregate the stateless DNA of crnrstn's environmental detection to the global config file.   

Consider the needs of multiple (and not necessarily identical) hosting environments.
- possibly different directory paths to different types of resources for the same/identical functions
- possibly different users with highly securitized/sandboxed access to the resources of their respective environment(s)
- need to be able to extrapolate critical environment details in a rigid & secure (but still cross-environmentally consistent) way

Methods of environment detection
- Check for existence of PATH or URI.
- Check for existence of file
- Use file contents for explicit definition of environment therein (recommend using PATH to a detect file that is excluded from RTM promotions)
- Consider a defacto unit test for validation/establishment of environmental detection + all critical components therein

Protocol 
- Initialize session / Wake up
- Initialize logging mechanisms to capture or bubble up session status 
- Initialization of any security checks before any add'l resources are made available to the session. Terminate or escalate the exceptions.



Directory Structure [directory-name]  - - - file-name
- crnrstn.root.inc.php
- [crnrstn_host]
- - [crnrstn_host]
- - - crnrstn.host.config.php
- - [crnrstn_root]
- - - crnrstn.config.php
- - - [crnrstn_classes]
- - - - [security]
- - - - - crnrstn.security.php
- - - - [soa]
- - - - - [nusoap_0.9.5]
- - - - [env]
- - - - - crnrstn.env.php
- - - - [db]
- - - - - [mysqli]
- - - - - [mysql]
- - - - - [mssql]
- - - - [logging]
- - - - - []
- - - - - crnrstn.log.php


*/




?>