/*
File:				RPG_driver.cpp
Programmer:			Jonathan Harris
Last Modified:		11.25.2002
Description:		Game driver.
*/

#include <string.h>
#include <ctype.h>
#include <fstream.h>
#include <iostream.h>
#include <stdlib.h>

#include "player_1.h"						// include header files
#include "arsenal.h"
#include "input_Filter.h"
#include "element_Display.h"

void game_Initialization(); 				// set up player game(screen centering, name entering)
void weapons_Initialization(double &, int &, int &, int&, int&, int&);
void process_Input(int &);					// receive all user input and process for program decision
void display_Instructions();
void show_Payload(double &, int&, int&, int&, int&);
void start_Game(double &c, int &, int &, int &, int &, int &);
void sam_Sequence(double &, int&, int&, int&, int&);
void enemy_Sequence(double &, int&, int&, int&, int&, int&, int&, int&, int&);

#define FLARE_WEIGHT    200					// Program constants defined globally
#define CHAFF_WEIGHT    500
#define AIM_120_WEIGHT  500
#define SIDEWIND_WEIGHT 400


int main()
{
//********************************************************************************************
//***************************VARIABLE DEFINITIONS*********************************************
	int num_Flare = 0, num_Chaff = 0, num_Aim = 0, num_Side = 0;		// var to store quantities on hand
	double avaliable_Weight = 4000;										// avaliable weight
	int choice = 0, trip = 0;
	element_Display menu_Scene;
//********************************************************************************************

	game_Initialization();						// game is initialized and chance given to by-pass instructions

	process_Input(choice);						// take user char string input and convert to int for switch

	switch(choice){								// display menu, start game, exit game
	case 4:										// show me instructions
		menu_Scene.instructions();				// display instructions
		// no break!
	case 5:										// start game please
		menu_Scene.scene_1();					// air base scene..enemies are coming
		while(trip == 0)
		{
			menu_Scene.menu_2();				// (add, remove, begin, exit) menu
			show_Payload(avaliable_Weight, num_Flare,num_Chaff, num_Aim, num_Side);
			//*********** allow user to add/remove weapons for game **********************
			weapons_Initialization(avaliable_Weight, num_Flare, num_Chaff, num_Aim, num_Side, trip);
		}
		if(trip == 3)
		start_Game(avaliable_Weight, num_Flare,num_Chaff, num_Aim, num_Side, trip);
		break;
	case 3:
		cout << "Thanks for playing Fighter RPG!" << endl;
		exit(0);
		break;

	default:
		{
		cout <<"\n\nPlease restart the game and make sure to enter \"show\" to see the instructions."<< endl;
		cout <<" Your entry was not an avaliable selection, and in life, as in this";
		cout <<" program, \nthere are no second chances."<<endl;
		}
	}
	cout << "\nI hope you have enjoyed your experience of Fighter RPG!" << endl;
	cout << "\t\t\t\t\t\t\tThanks for playing."<< endl;

	return 0;
}


void game_Initialization()
{
	player_1 player;						// player_1 object player
	arsenal items;							// arsenal object items 
	player.clear_File();					// clear output file for new game

//****************SCREEN SYNC DISPLAY*********************
	player.zero_Screen();					//zero screen
//***********************************************************
	player.clear_Screen_Return();			// clear screen
	player.title_Screen();					// Display title page
	player.enter_Name();					// write name to file...up to 29 char
	player.clear_Screen();					// clear screen
	player.show_Jet();						// Display jet pic

	// instruction skip menu
	player.display_Full_Name();
	player.program_Opening_Menu();			// pre game menu
}
//==============================================================================
//==================== Processor mech. for all user menu choices ===============
//==============================================================================
void process_Input(int &choice)
{
	input_Filter input;						// define variable for user input
	input.receive_Input();					// receive input
	choice = input.input_Compare();
}
//==============================================================================
//================== Huge Messy Switch for Item addind/removing ================
//==============================================================================
void weapons_Initialization(double &weight, int &flare, int &chaff, int &aim, int &side, int &trigger)
{
	element_Display menu_Scene;
	int quantity, go_On = 0, choice;
	char input;
	double temp_Weight;

	process_Input(choice);					// receive user decision to (add,remove,start,exit)
	switch (choice)
	{
	case 0:			//add
		menu_Scene.menu_3();				// ~ display select item to add(menu)
		show_Payload(weight, flare, chaff, aim, side);
		process_Input(choice);				// recieve request and return item to add (flare, chaff, side, aim)
		switch(choice){
		case 6:		// add flare
				cout << "Enter quantity of Flares to add: ";
//				cin  >> quantity;
				cin >> input;
				quantity = (input - '0');
				temp_Weight = weight - (quantity * FLARE_WEIGHT);
				if(temp_Weight <0){
					cout << "You do not have the capacity to add " <<quantity<<" flares.\a"<< endl;
				}
				else{
					weight = temp_Weight;
					flare += quantity;
				}
			break;
		case 7:		// add chaff
				cout << "Enter quantity of Chaff to add: ";
//				cin  >> quantity;
				cin >> input;
				quantity = (input - '0');
				temp_Weight = weight - (quantity * CHAFF_WEIGHT);
				if(temp_Weight <0){
					cout << "You do not have the capacity to add " <<quantity<<" chaff.\a"<< endl;
				}
				else{
					weight = temp_Weight;
					chaff += quantity;
				}
			break;
		case 8:		// add side
				cout << "Enter quantity of Sidewinders to add: ";
//				cin  >> quantity;
				cin >> input;
				quantity = (input - '0');
				temp_Weight = weight - (quantity * SIDEWIND_WEIGHT);
				if(temp_Weight <0){
					cout << "You do not have the capacity to add " <<quantity<<" sidewinders.\a"<< endl;
				}
				else{
					weight = temp_Weight;
					side += quantity;
				}
			break;
		case 9:		// add aim
				cout << "Enter quantity of Aim-120's to add: ";
//				cin  >> quantity;
				cin >> input;
				quantity = (input - '0');
				temp_Weight = weight - (quantity * AIM_120_WEIGHT);
				if(temp_Weight <0){
					cout << "You do not have the capacity to add " <<quantity<<" Aim-120's.\a"<< endl;
				}
				else{
					weight = temp_Weight;
					aim += quantity;
				}
			break;
		default:
			cout << "**************** No item was selected to ADD ****************\a"<<endl;
		}								// end add item switch
		break;
	case 1:			//remove
		menu_Scene.menu_4();			// ~display "select item to add"(menu)
		show_Payload(weight, flare, chaff, aim, side);
		process_Input(choice);			// recieve request and return item to add (flare, chaff, side, aim)
		switch(choice)
		{
		case 6:		// remove flare
			cout << "Enter quantity of Flares to remove: ";
//				cin  >> quantity;
				cin >> input;
				quantity = (input - '0');
			if(quantity <= flare)
			{
				weight = weight + (quantity * FLARE_WEIGHT);
				flare = flare - quantity;
			}
			else
			{
				cout << "You do not have "<<quantity<< " flares to remove.\a"<< endl;
			}
			break;
		case 7:		// remove chaff
			cout << "Enter quantity of Chaff to remove: ";
//				cin  >> quantity;
				cin >> input;
				quantity = (input - '0');
			if(quantity <= chaff)
			{
				weight = weight + (quantity * CHAFF_WEIGHT);
				chaff = chaff - quantity;
			}
			else
			{
				cout << "You do not have "<<quantity<< " chaff to remove.\a"<< endl;
			}
			break;
		case 8:		// remove side
			cout << "Enter quantity of SideWinders to remove: ";
//				cin  >> quantity;
				cin >> input;
				quantity = (input - '0');
			if(quantity <= side)
			{
				weight = weight + (quantity * SIDEWIND_WEIGHT);
				side = side - quantity;
			}
			else
			{
				cout << "You do not have "<<quantity<< " sidewinders to remove.\a"<< endl;
			}
			break;
		case 9:		// remove aim
			cout << "Enter quantity of Aim-120's to remove: ";
//				cin  >> quantity;
				cin >> input;
				quantity = (input - '0');
			if(quantity <= aim)
			{
				weight = weight + (quantity * AIM_120_WEIGHT);
				aim = aim - quantity;
			}
			else
			{
				cout << "You do not have "<<quantity<< " Aim-120's to remove.\a"<< endl;
			}
			break;
		default:
			cout << "*************** No item was selected to REMOVE ***************.\a"<<endl;
		}
		break;
	case 2:			//start combat mission
		// begin action sequence
		trigger = 3;
		break;
	case 3:			//exit
		trigger = 1;
//		exit(1);
		break;
	default:
		//standard non-menu choice responce
		cout<< "**********   NO CHOICE SELECTED   **********\a"<< endl;
	}

}
//==============================================================================
//================== For Display of Current Item Payload ======================
//==============================================================================
void show_Payload(double &cap, int &flares, int &chaff, int &aim, int &side)
{
	cout << "Current Payload: \n\tFlares     (200 lb):\t"<< flares 
	 	 <<"\n\tChaff      (500 lb):\t" << chaff  
		 <<"\n\tAim_120    (500 lb):\t"<<  aim  
		 <<"\n\tSideWinder (400 lb):\t"<<side<<"\n"<<endl;
	cout <<"\t\tAvalable Capacity: "<<cap<<" lbs."<<endl;
	cout << "\n\n\n\n\n\nPlease enter your selection: ";
}
//==============================================================================
//=============== MAIN SWITCH...I Know, this is a real PIECE huh? ==============
//==============================================================================

void start_Game(double &cap, int &flares, int &chaff, int &aim, int &side, int &trigger)
{
	element_Display menu, scene;		// use menu for menus and scene...
	int choice = 0;
	int f1_flare = 2, f1_chaff = 0, f1_side = 5, f1_aim = 0;// 
	int f2_flare = 0, f2_chaff = 2, f2_side = 0, f2_aim = 5;		// fighter arms
	int f3_flare = 1, f3_chaff = 1, f3_side = 5, f3_aim = 0;
	player_1 maintenance;

	scene.scene_2();					// display briefing for plane take off
	menu.menu_5();						// menu for CLIMB, SOUTH, EAST, EXIT
	process_Input(choice);

	switch(choice){
	case 12:						// climb
		maintenance.clear_Screen_Return();
		cout << "Your climb to a safe cruising altitude."<< endl;
		menu.menu_6();					// menu for South/exit
		show_Payload(cap, flares,chaff, aim, side);
		process_Input(choice);
	
		switch(choice){
		case 10:					// south
			cout << "You are high in the sky and decide to fly south."<<endl;

			menu.menu_6();				// menu for South/Exit
			show_Payload(cap, flares,chaff, aim, side);
			process_Input(choice);
			switch(choice){
			case 10:				// south
				cout << "You continue south, and pick up on a SAM site below you."<< endl;
				cout << "Fortunately, your altitude put you out of harms way."<< endl;
		
				cout << "You pick up on 2 fighter jets in your area...\a"<< endl;

				menu.menu_7();			// menu for attack to east/attack to west/pee in your pants...attack_Menu_1
				show_Payload(cap, flares,chaff, aim, side);
				process_Input(choice);
				switch(choice){
				case 13:			//pee in your pants
					cout << "You are a wuss..."<< endl;
					break;
				case 11:			// east
					cout << "You are attacked by bandit #1...\a" << endl;
					// *********************Attack sequence for bandit 1********
					enemy_Sequence(cap, flares, chaff, aim, side, f1_flare, f1_chaff, f1_aim, f1_side);		// fighter battle
					menu.menu_6();		// south/exit
					show_Payload(cap, flares,chaff, aim, side);
					process_Input(choice);
					switch(choice){
					case 10:			// south
						cout << " A SAM site has locked onto your position and a missile is";
						cout <<" headed your way!\a"<< endl;
							
						//******************SAM site sequence*******************
						sam_Sequence(cap, flares, chaff, aim, side);
						menu.menu_6();			// go south/exit
						show_Payload(cap, flares,chaff, aim, side);
						process_Input(choice);
						switch(choice){
						case 10:		// south
							cout << "A bandit has creeped up on your back..."<<endl;
							//***************ATTACK sequence for bandit 3*********
							enemy_Sequence(cap, flares, chaff, aim, side, f3_flare, f3_chaff, f3_aim, f3_side);		// fighter battle
							menu.menu_8();			// go west/exit
							show_Payload(cap, flares,chaff, aim, side);
							process_Input(choice);
							switch(choice){
							case 14:				// west
								cout << "Your warning system has indicated that a SAM Site is tracking you.\a"<<endl;
								//************************ SAM site sequence **************************
								sam_Sequence(cap, flares, chaff, aim, side);
								menu.menu_10();			// NORTH/exit
								show_Payload(cap, flares,chaff, aim, side);
								process_Input(choice);
								switch(choice){
								case 15:			// NORTH
									cout << "Another Enemy Fighter has been found, and he is locked onto you." <<endl;
									// ************************ fighter 2 sequence ************************
									enemy_Sequence(cap, flares, chaff, aim, side, f2_flare, f2_chaff, f2_aim, f2_side);		// fighter battle
									menu.menu_10();			//north/exit
									show_Payload(cap, flares,chaff, aim, side);
									process_Input(choice);
									switch(choice){
									case 15:		//north
										cout << "To your amazement, another surface to air missile site is ";
										cout << "locked and loaded!\a"<<endl;
											// ********************* SAM SITE Sequence **********************
										sam_Sequence(cap, flares, chaff, aim, side);
	//******THIS SHOULD BE THE DEATH OF YOU****
										cout << "If you are reading this, the game scope did not account\n";
										cout <<"for all variables."<< endl; 
										break;
									case 3:			// exit
										cout << "Thanks for playing Air Fighter RPG!"<<endl;
										exit(0);
										break;
									default:
										cout<< "As sometimes in life, there are no second chances for input here...."<<endl;
									}
									break;
								case 3:
									cout <<"Thanks for playing Air Force RPG!"<<endl;
									exit(0);
								break;
								default:
									cout << "As sometimes in life, there are no second chances for input here...."<<endl;
								}
							case 3:				//exit
								cout << "Thanks for playing Air Fighter RPG!" << endl;
								exit(0);
								break;
							default:
								cout <<"As sometimes in life, there are no second chances for input here...."<<endl;
							}
							break;
						case 3:			// exit
							cout << "Thanks for playing Fighter RPG!"<< endl;
							exit(0);
							break;
						default:
							cout << "You entered something which was nothing... unfortuantely you must restart..."<< endl;
						}
						break;
					case 3:				// exit
						cout << "Thanks for playing Fighter RPG!"<< endl;
						exit(0);
						break;
					default:
						cout << "Sorry...incorrect input."<< endl;
					}
					break;
				case 14:			// west
					cout << "You are being attacked by a bandit...\a" << endl;
					// *********************Attack sequence for bandit 2 ********************
					enemy_Sequence(cap, flares, chaff, aim, side, f2_flare, f2_chaff, f2_aim, f2_side);		// fighter battle
					menu.menu_6();		// south/exit
					show_Payload(cap, flares, chaff, aim, side);
					process_Input(choice);
					switch(choice){
					case 10:		// south
						cout << "SAM SITE ATTACK!!...A radar guided package brings death!!\a"<<endl;
						//****************** SAM SITE SEQUENCE ********************
						sam_Sequence(cap, flares, chaff, aim, side);
						menu.menu_9();		// east/exit
						show_Payload(cap, flares, chaff, aim, side);
						process_Input(choice);
						switch(choice){
						case 11:			// east
							cout << "You have been intercepted by bandit #3...\a"<<endl;
							//***********    BANDIT 3 SEQUENCE    *****************
							enemy_Sequence(cap, flares, chaff, aim, side, f3_flare, f3_chaff, f3_aim, f3_side);		// fighter battle
							menu.menu_10();			//north/exit
							show_Payload(cap, flares, chaff, aim, side);
							process_Input(choice);
							switch(choice){
							case 15:	// North 
								cout << "You have encountered a SAM SITE.\a"<<endl;
								//************* SAM SITE SEQUENCE *****************
								sam_Sequence(cap, flares, chaff, aim, side);
								menu.menu_10();		// north/exit
								show_Payload(cap, flares, chaff, aim, side);
								process_Input(choice);
								switch(choice){
								case 15:		//NORTH
									cout << "You have located the last of the bandits..\a"<< endl;
									//********************* BANDIT 1 SEQUENCE ********************
									enemy_Sequence(cap, flares, chaff, aim, side, f1_flare, f1_chaff, f1_aim, f1_side);		// fighter battle
									cout << " Great job!  All bandits have been dealt with."<<endl;
									cout << "Thanks for playing.........."<<endl;
									maintenance.clear_Screen_Return();		// press return for dramatic ending
									maintenance.title_Screen();				//***********END GAME******************
			//						exit(0);
									break;
								case 3:
									cout << "Thanks for playing Fighter RPG!"<< endl;
									exit(0);
								default:
									cout << "Sorry...Not good input."<< endl;									
								}
								break;
							case 3:		// exit
								cout << "Thanks for playing Fighter RPG!"<< endl;
								exit(0);
								break;
							default:
								cout <<" Your selection is not a menu choice...sorry."<<endl;
							}
							break;
						case 3:				// exit
							cout << "Thanks for playing Fighter RPG!"<< endl;
							exit(0);
							break;
						default:
							cout <<"You have entered an incorrect selection." << endl;
						}
						break;
					case 3:			//exit
						cout << "Thanks for playing Fighter RPG!"<< endl;
						exit(0);
						break;
					default:
						cout << "Incorrect responce." << endl;
					}
					break;
				default:
					cout << " I am not understanding you here."<< endl;
				}
				break;
			case 3:						// exit
				cout << "Thanks for playing Fighter RPG!"<< endl;
				exit(0);
				break;
			default:
				cout << "I think I am becoming illiterate." << endl;
			}
			break;
		case 3:
			cout << "Thanks for playing Fighter RPG!"<< endl;
			exit(1);
		break;
		default:
			cout << "Yeah, ok...whatever."<< endl;
		}
		break;
	case 10:	// south
		cout << "You head south from the base."<< endl;
		menu.menu_6();		// south/exit
		show_Payload(cap, flares,chaff, aim, side);
		process_Input(choice);
		switch(choice){
		case 10:	// south
			cout << "You continue south into enemy territory."<<endl;
			menu.menu_6();		// south/exit
			show_Payload(cap, flares,chaff, aim, side);
			process_Input(choice);
			switch(choice){
			case 10:	// south
				cout << "You have encountered a SAM SITE and a radar guided projectile is coming!\n\a";
				
				//************** SAM SITE SEQUENCE ***********************
				sam_Sequence(cap, flares, chaff, aim, side);
				menu.menu_6();			//south/exit to enemy #2
				show_Payload(cap, flares,chaff, aim, side);
				process_Input(choice);
				switch(choice){
				case 10:		// south to bandit #2
					cout << "You have encountered a bandit...look out, he packs some power!!\a"<< endl;
					//************ BANDIT SEQUENCE #2 *******************
					enemy_Sequence(cap, flares, chaff, aim, side, f2_flare, f2_chaff, f2_aim, f2_side);		// fighter battle
					menu.menu_6();			// south/exit
					show_Payload(cap, flares,chaff, aim, side);
					process_Input(choice);
					switch(choice){
					case 10:			// south
						cout << "Another stinkin' SAM site has locked onto you...\a"<< endl;
						//************ SAM SITE sequence ***********
						sam_Sequence(cap, flares, chaff, aim, side);
						menu.menu_9();    //east only or exit
						show_Payload(cap, flares,chaff, aim, side);
						process_Input(choice);
						switch(choice){
						case 11:		// east
							cout << "An enemy fighter has you in his sights...\a\a"<< endl;
							//************************** ENEMY FIGHTER 3 SEQUENCE ********************
							enemy_Sequence(cap, flares, chaff, aim, side, f3_flare, f3_chaff, f3_aim, f3_side);		// fighter battle
							menu.menu_10();				// north or exit
							show_Payload(cap, flares,chaff, aim, side);
							process_Input(choice);
							switch(choice){
							case 15:		//NORTH
								cout << "You have encountered another sam site...\a"<<endl;
								//************ SAM SITE sequence ********************
								sam_Sequence(cap, flares, chaff, aim, side);
								menu.menu_10();			// NORTH/exit only
								show_Payload(cap, flares,chaff, aim, side);
								process_Input(choice);
								switch(choice){
								case 15:	// NORTH
									cout << "You have miraculously located another enemy fighter!!\a\a"<< endl; //fighter1
									//************ FIGHTER 1 sequence *************************
									enemy_Sequence(cap, flares, chaff, aim, side, f1_flare, f1_chaff, f1_aim, f1_side);		// fighter battle
									//END OF GAME BY THIS POINT FOR SURE DUE TO LACK OF PROVISIONS.......
									cout << "If you are reading this, the game scope did not account\n";
									cout <<"for all variables."<< endl;
									break;
								case 3:		// exit
									cout<<"Thanks for playing Fighter RPG!"<< endl;
									exit(0);
								}
								break;
							case 3:			// exit
								cout << " Thanks for playing..."<< endl;
								exit(0);
								break;
							}
							break;
						case 3:
							cout << "Thanks for playing Fighter RPG!"<< endl;
							exit(0);
							break;
						default:
							cout << " No input accepted."<< endl;
						}
						break;
					case 3:			// exit
						cout << "Thanks for playing."<< endl;
						exit(0);
						break;
					}
					case 3:		//exit
					cout << "Thanks for playing"<<endl;
					exit(0);
					break;
				}						
				break;
			case 3:		// exit
				cout << "Thanks for playing Fighter RPG!"<< endl;
				exit(0);
				break;
			default:
				cout << "No 2nd chances in life or this game."<<endl;
			}
				break;
		case 3:		// exit
			cout << "Thanks for playing Fighter RPG!"<< endl;
			exit(0);
			break;
		default:
			cout << "No 2nd chances in life or this game."<<endl;
		
		}
		break;
	case 11:	// east
		cout << "You fly east out of the base."<< endl;
		menu.menu_6();
		show_Payload(cap, flares,chaff, aim, side);
		process_Input(choice);
		switch(choice){
			case 10:		// south
				menu.menu_6();			//south/exit
				show_Payload(cap, flares,chaff, aim, side);
				process_Input(choice);
				switch(choice){
				case 10:	// south
					cout << "Careful...A bandit at 3 o'clock has you in his sights!!\a" << endl;
					// ******************** fighter Sequence 1  ********************
					enemy_Sequence(cap, flares, chaff, aim, side, f1_flare, f1_chaff, f1_aim, f1_side);		// fighter battle
					menu.menu_6();		// south/exit
					show_Payload(cap, flares,chaff, aim, side);
					process_Input(choice);
					switch(choice){
					case 10:
						cout << "********** You have encountered a stinking sam site...\a"<<endl;
						// ******************** SAM SITE ********************
						sam_Sequence(cap, flares, chaff, aim, side);
						menu.menu_6();	//south/exit
						show_Payload(cap, flares,chaff, aim, side);
						process_Input(choice);
						switch(choice){
						case 10:		//south
							cout << "**Look out! A rocket propelled projectile is on its way!\a" <<endl;
							// ******************** Fighter 3 Sequence ********************
							enemy_Sequence(cap, flares, chaff, aim, side, f3_flare, f3_chaff, f3_aim, f3_side);		// fighter battle
							menu.menu_8();		//west/exit
							show_Payload(cap, flares,chaff, aim, side);
							process_Input(choice);
							switch(choice){
							case 14:		// west
								cout <<" Hey, that not your mom down there takin' pictures of you.\a" << endl;
							// ******************** SAM sequence *****************
								sam_Sequence(cap, flares, chaff, aim, side);
								menu.menu_10();			//north/exit
								show_Payload(cap, flares,chaff, aim, side);
								process_Input(choice);
								switch(choice){
								case 15:	//NORTH
									//******************** fighter 2 sequence ***************
									enemy_Sequence(cap, flares, chaff, aim, side, f2_flare, f2_chaff, f2_aim, f2_side);		// fighter battle
									menu.menu_10();		// north/exit
									show_Payload(cap, flares,chaff, aim, side);
									process_Input(choice);
									switch(choice){
									case 15:
										cout <<" Holy Cow!  A radar guided projectile is headed your way!\n";
										// ****************** SAM sequence ********************
										sam_Sequence(cap, flares, chaff, aim, side);
										// ****************** END OF GAME *********************
										cout << "If you are reading this, the game scope did not account\n";
										cout <<"for all variables."<< endl;
										break;
									case 3:
										cout << "Thanks for playing AIR fighter RPG!"<< endl;
										exit(0);
										break;
										default:
										cout << "As in life, there are no second chances." << endl;
									  }
									break;
								case 3:		//exit
									cout << "Thanks for playing Fighter RPG!"<< endl;
									exit(0);
									break;
								default:
									cout << "As in life, there are no second chances here."<< endl;
								}
							case 3:
								cout << "Thanks for playing Fighter RPG!"<< endl;
								exit(0);
								break;
							default:
								cout << "Could not accept input."<< endl;
							}
							break;
						case 3:			// exit
							cout << "Thanks for playing Fighter RPG!"<< endl;
							exit(0);
							break;
						default:
							cout << " Sorry.  Incorrect input...no second chances in life or this game..."<< endl;
						  }
					case 3:
						cout << "Thanks for playing Fighter RPG!"<< endl;
						exit(0);
						break;
					default:
						cout << " Sorry.  Incorrect input...no second chances in life or this game..."<< endl;
					}
				case 3:
					cout << "Thanks for playing Fighter RPG!"<< endl;
					exit(0);
					break;
				default:
					cout << "As it is sometimes in life, there are no second chances for YOU now."<< endl;
				}
			case 3:
				cout << "Thanks for playing Fighter RPG!"<< endl;
				exit(0);
				break;
			default:
				cout << " Sorry.  Incorrect input...no second chances in life or this game..."<< endl;
				}				
			break;
	case 3:		// exit
		cout << "Thanks for playing Fighter RPG!"<< endl;
		exit(0);
		break;
	default:
		cout << "Sorry, your entry was not an avaliable one."<< endl;
	}
}		// END start_Game function containing all switch statements


//==============================================================================
//====================== Another SWITCH...ANOTHER real PIECE  ==================
//==============================================================================
void sam_Sequence(double &weight, int &flare, int &chaff, int &aim, int &side)			// sam site battle
{
	element_Display show;

	int choice;

	show.attack_Choices();	
	show_Payload(weight,flare,chaff,aim,side);
	process_Input(choice);
	switch(choice){
	case 7:			// chaff results in life
		if(chaff)
		{
			cout <<"You fire off some chaff...and the missile was diverted!  Good work." << endl;
			chaff -= 1;			// minus one chaff
			weight += CHAFF_WEIGHT;
		}
		else
		{
			cout <<"You have no more chaff to deploy.....the missile was able to find its target."<< endl;
			show.game_Over();
			exit(0);
		}
		break;
	case 6:			// flare results in death
		if(flare){
			cout << " Unless your flare were to defy all odds and hit the radar guided missile\n";
			cout << "you really would have had no chance...Flares have no effect on radar guided\n";
			cout << "missiles."<< endl;
			show.game_Over();
			exit(0);
		}
		else{
			cout <<"You have no more flare to deploy.....the missile was able to find its target."<< endl;
			show.game_Over();
			exit(0);
		}
	case 8:			// sidewinder
		if(!side){
			cout <<"You have no sidewinders to deploy...and even if you did, the missile\n";
			cout << "would still be able to find its target."<< endl;
			show.game_Over();
			exit(0);
		}
		else{
			cout << "Hello...is anybody home...? You can't shoot down a missile with that. Next time\n";
			cout << "fire your chaff...or did you not buy enough of it?"<< endl;
			show.game_Over();
			exit(0);
		}
		break;
	case 9:			// aim
		if(aim){
			cout << "Hello...is anybody home...? You can't shoot down a missile with that. Next time\n";
			cout << "fire your chaff...or did you not buy enough of it?"<< endl;
			show.game_Over();
			exit(0);
		}
		else{
			cout <<"You have no AIM-120's to deploy...and even if you did, the enemy missile\n";
			cout << "would still be able to find its target."<< endl;
			show.game_Over();
			exit(0);
		}
	case 13:		//PEE
		cout << "Nice try :-)  The fact that you were staring death in the eyes didn't have any\n";
		cout << "effect on this decision did it? .....Death to you in your wet pants!" << endl;
		show.game_Over();
		exit(0);
		break;
	default:
		cout << "Sorry, no second chances in life or this game!"<<endl;
		show.game_Over();	
		exit(0);
	}
}

//==============================================================================
//===============           Sorry for the uglyness                ==============
//==============================================================================

void enemy_Sequence(double &weight, int &flare, int &chaff, int &aim, int &side, int &bad_flare, int &bad_chaff, int &bad_aim, int &bad_side)		// fighter battle
{
	element_Display show;							// all side fires first, then all aim 
	bool victory = 0;
	int choice;

	show.attack_Choices();	
	show_Payload(weight,flare,chaff,aim,side);
	do
	{
		cout << "\b\b. Your sensors indicate that a ";
		if(bad_side){
			cout << "heat seeking missile \nhas been fired at you: ";
			bad_side -= 1;
			}
		else{
			bad_aim -= 1;
			cout << "radar guided \nmissile is headed in your \"general\" direction: ";
		}
		process_Input(choice);
		switch(choice){
		case 7:			// chaff
		if(!chaff){
			cout <<"You have no more chaff to deploy.....the missile was able to find its target."<< endl;
			show.game_Over();
			exit(0);
		}
		else
		{
			chaff -= 1;
			if(bad_side)
			{
				cout << "Unfortunately your chaff did not do what it was NOT designed \nto do. ";
				cout << "Therefore Death is dealt to you." << endl;
				show.game_Over();
				exit(0);
			}
			else
			{
				if(bad_aim)
				{
					cout << "Excellent job!  The chaff diverted the missile from hitting its target...you." << endl;
					cout << "********** Now is your chance to attack.  Choose your weapon wisely. **********" << endl;
					show.attack_Choices();
					show_Payload(weight,flare,chaff,aim,side);
					process_Input(choice);
	
					switch(choice){				// 7chaff,6flare,8side,9aim,13pee,default
					case 7:		//chaff
						if(chaff)
							chaff -= 1;
						else{
							cout <<"You have no more chaff to deploy. If you did, surely it would hurt him."<< endl;
							show.attack_Choices();
							show_Payload(weight, flare ,chaff , aim , side);
						}
					case 6:		//flare
						if(choice == 6 && flare)
						{
							flare -= 1;
							cout<< "Good one, I am sure that the defensive mechanism you fired hurt his feelings...\n  ";
							show.attack_Choices();
							show_Payload(weight, flare ,chaff , aim , side);
						}
						else{
							cout <<"You have no more flare to deploy...as if it would have helped..."<< endl;
						}
						break;
					case 8:		//side
						if(side){
							side -= 1;
							if(bad_flare)
							{
								bad_flare -= 1;
								cout <<"************** The bandit has released some flare and avoided your attack..." << endl;
								show.attack_Choices();
								show_Payload(weight, flare ,chaff , aim , side);
							}
							else
							{
								victory = 1;
								cout << " ** The enemy fighter has just taken one where the sun doesn't shine! Hooray!!\a"<< endl;
							}
						}
						else{
							cout <<"You have no more sidewinders to deploy.\a\a"<< endl;
							show.attack_Choices();
							show_Payload(weight, flare ,chaff , aim , side);
						}
						break;
					case 9:		//aim
						if(aim){
							aim -= 1;
							if(bad_chaff)
							{
								bad_chaff -= 1;
								cout <<"************** The bandit has released some chaff and distracted your attack..." << endl;
								show.attack_Choices();
								show_Payload(weight, flare ,chaff , aim , side);
							}
							else
							{
								victory = 1;
								cout << " ** The enemy fighter has just taken one where the sun doesn't shine! Hooray!!\a" << endl;
							}
							break;
						}
						else{
							cout <<"You have no more AIM-120 to deploy...\a\a"<< endl;
							show.attack_Choices();
							show_Payload(weight, flare ,chaff , aim , side);
						}
						
					case 13:	//pee
						cout << "Nice try :-)  The fact that you were staring death in the eyes didn't have any\n";
						cout << "effect on this decision did it? .....Death to you in your wet pants!" << endl;
						show.game_Over();
						exit(0);
						break;
					default:
						cout << "I guess you don't know how to type..."<< endl;
					}
					break;
				}
			}
		}
		case 6:			// flare
			flare -= 1;
			if(bad_aim)
			{
				cout << "Unfortunately your flare did not do what it was not designed to do. ";
				cout << "Death to you." << endl;
				show.game_Over();
				exit(0);
			}
			else
				if(bad_side){
					cout << "Excellent job!  The flare diverted the missile from hitting its target...you." << endl;
					cout << "********** Now is your chance to attack.  Choose your weapon wisely. **********" << endl;
					show.attack_Choices();
					show_Payload(weight,flare,chaff,aim,side);
					process_Input(choice);
	
					switch(choice){				// 7chaff,6flare,8side,9aim,13pee,default
					case 7:		//chaff
						chaff -= 1;
					case 6:		//flare
						if(choice == 6)
							flare -= 1;
						cout<< "Good one, I am sure that the defensive mechanism you fired hurt his feelings..." << endl;
						show.attack_Choices();
						show_Payload(weight, flare ,chaff , aim , side);
						break;
					case 8:		//side
						side -= 1;			// minus one
						if(bad_flare)
						{
							bad_flare -= 1;
							cout <<"************** The bandit has released some flare and avoided your attack..." << endl;
							show.attack_Choices();	
							show_Payload(weight,flare,chaff,aim,side);
						}
						else
						{
							victory = 1;
							cout << " ** The enemy fighter has just taken one where the sun doesn't shine! Hooray!!\a"<< endl;
						}
						break;
					case 9:		//aim
						aim -=1;
						if(bad_chaff)
						{
							bad_chaff -= 1;
							cout <<"************** The bandit has released some chaff and distracted your attack..." << endl;
							show.attack_Choices();	
							show_Payload(weight,flare,chaff,aim,side);
						}
						else
						{
							victory = 1;
								cout << " ** The enemy fighter has just taken one where the sun doesn't shine! Hooray!!\a"<< endl;
						}
						break;
					case 13:	//pee
						cout << "Nice try :-)  The fact that you were staring death in the eyes didn't have any\n";
						cout << "effect on this decision did it? .....Death to you in your wet pants!" << endl;
						show.game_Over();
						exit(0);
						break;
					default:
						cout << "I guess you don't know how to type..."<< endl;
					}
				}
			break;
		case 8:			// sidewinder
			side -=1;
		case 9:			// aim
			if(choice == 9)
				aim -= 1;
			cout << "Hello...is anybody home...? You can't shoot down a missile with that. Next time\n";
			cout << "fire your chaff or a flare...or did you not buy enough of those?"<< endl;
			show.game_Over();
			exit(0);
		case 13:		//PEE
			cout << "Nice try :-)  The fact that you were staring death in the eyes didn't have any\n";
			cout << "effect on this decision did it? .....Death to you in your wet pants!" << endl;
			show.game_Over();
			exit(0);
			break;
		default:
			cout << "Sorry, no second chances in life or this game!"<<endl;
			show.game_Over();	
			exit(0);
		}

	}while(victory == 0);
 }			// end of function
