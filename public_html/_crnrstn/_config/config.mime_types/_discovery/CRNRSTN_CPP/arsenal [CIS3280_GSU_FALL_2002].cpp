/*
File:				arsenal.cpp
Programmer:			Jonathan Harris
Last Modified:		11.25.2002
Description:		Member function definitions for abstract class arsenal...
*/

#include <stdlib.h>
#include <iostream.h>
#include "arsenal.h"
#include "player_1.h"

arsenal::arsenal() : player_1(){}

arsenal::~arsenal(){}
//***********************************************************
//***********************************************************
void arsenal::opening_Menu()
{
	ifstream menu_File;
	menu_File.open ("menus\\opening_Menu.txt", ios::in);
	if(!menu_File)									// standard form of error checking for this?  Try loop not necessary
		{
			cerr << "File \"menus\\opening_Menu.txt\" could not be found."<< endl;		// I hope this works...test it.
			exit(1);
		}

	while((pix = menu_File.get()) != EOF)
		{
		cout << pix;
		}		

	menu_File.seekg(0);								//move to the beginnning of file for next read
	menu_File.close();
}
//***********************************************************
//***********************************************************

void arsenal::remove_Arms_Menu()
{
	ifstream menu_File;
	menu_File.open ("menus\\remove_Arms.txt", ios::in);
	if(!menu_File)									// standard form of error checking for this?  Try loop not necessary
		{
			cerr << "File \"menus\\remove_Arms.txt\" could not be found."<< endl;		// I hope this works...test it.
			exit(1);
		}

	while((pix = menu_File.get()) != EOF)
		{
			cout << pix;
		}		

	menu_File.seekg(0);								//move to the beginnning of file for next read
	menu_File.close();
}
//***********************************************************
//***********************************************************

void arsenal::add_Arms_Menu()
{
	ifstream menu_File;
	menu_File.open ("menus\\add_Arms.txt", ios::in);
	if(!menu_File)									// standard form of error checking for this?  Try loop not necessary
		{
			cerr << "File \"menus\\add_Arms.txt\" could not be found."<< endl;		// I hope this works...test it.
			exit(1);
		}

	while((pix = menu_File.get()) != EOF)
		{
			cout << pix;
		}		

	menu_File.seekg(0);								//move to the beginnning of file for next read
	menu_File.close();
}
