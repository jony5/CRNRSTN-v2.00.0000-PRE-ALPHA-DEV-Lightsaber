/*
File:					assign_2
Last Modified:			1.24.2002
Author:					Jonathan Harris
Description:			   The purpose of this project is to convert USA dollars into 
						10 different European currencies following standad procedures 
						and displaying these 10 currency calculations along with a
						commision calculation.  The currency calculations must be lined 
						up and have stars filling the space between home position and first 
						character.
*/

#include <iostream.h>												    // preprocessor libary call-to-arms
#include <iomanip.h>													// Call for the manipulators in the 
																		// output zone.
int main()																// main program start.
{
	float dollar_Ini, Euro, payment, dollar_2;							// var. declarations using float... 
	float austr_Shlng2, brit_Pn2, belg_Frc2, dan_Kronr2, fnch_Frc2;		// so decimal can be stored and...
	float grm_Mrk2,	itl_Lira2, neth_Gldrs2,	prt_Escdo2,	spnsh_Pest2;	// will hold 7 digits



	//-------------[You are now entering the INPUT zone!!]-------------------------
	


	cout <<"  So that I may better serve you, please tell me how many dollars your customer\n"; 
	cout <<"would like to exchange for European currency: $";						// disp. req. for data input($US)							
	cin  >> dollar_Ini;																// await input of dollars
	cout <<" \n  Master, I now need the \"amount of Euro per US$\", and at your \n";//display request... 
	cout <<"command, I will remove your commission and calculate";					//for data input(Euro)
	cout <<"the respective amounts\n";											
	cout <<"in the listed European currencies: ";									
	cin  >> Euro;																	// await input of Euro per dollar
	


	//-------------[You are now entering the processing ZONE!!]--------------------



	payment = 0.2 * dollar_Ini;							// calculate commission...store in "payment"
		
	dollar_2 = dollar_Ini - payment;					// calc. dollars after commission...store in dollar_2
	
	//cout << dollar_2;									// a test for variable used to calc. exchange
	
	
	const float austr_Shlng1	= 13.76030  ;			// defining constants as float data type due...
	const float brit_Pnd1		= 0.61783   ;			// to digit precision
	const float belg_Frc1		= 40.33990  ;			
	const float dan_Kronr1		= 7.46179   ;			
	const float fnch_Frc1		= 6.55957   ;			
	const float grm_Mrk1		= 1.95583   ;			
	const float itl_Lira1		= 1936.27000;			
	const float neth_Gldrs1		= 2.20371   ;
	const float prt_Escdo1		= 200.48200 ;						
	const float spnsh_Pest1		= 166.38600 ;
	
	

	austr_Shlng2= dollar_2 * austr_Shlng1	* Euro;		// calculation of respective currenties and...
	brit_Pn2	= dollar_2 * brit_Pnd1		* Euro;		// assigning to variable
	belg_Frc2	= dollar_2 * belg_Frc1		* Euro;
	dan_Kronr2	= dollar_2 * dan_Kronr1		* Euro;
	fnch_Frc2	= dollar_2 * fnch_Frc1		* Euro;
	grm_Mrk2	= dollar_2 * grm_Mrk1		* Euro;	
	itl_Lira2	= dollar_2 * itl_Lira1		* Euro;	
	neth_Gldrs2	= dollar_2 * neth_Gldrs1	* Euro;
	prt_Escdo2	= dollar_2 * prt_Escdo1		* Euro;
	spnsh_Pest2 = dollar_2 * spnsh_Pest1	* Euro;
	
	cout <<"\n";										// go to next line


	//-------------[You are now entering the OUTPUT zone!!]-------------------------



	/* I have placed the explanation for this output above it for printing reasons...
	The code lines below are output commands for the resluts of the European currencies...
	I have used "setprecision(2)<<setw(10)<<setfill('*')<<setiosflags(ios::fixed)" so that the 
	displayed number will have an accuracy of 2 decimal places, have uniform spacing of 10 
	from home position of the text displayed, and have any empty space between home position and
	the first character filled with "*."
	*/

	cout << setprecision(2) << setw(10) << setfill('*') << setiosflags(ios::fixed) << austr_Shlng2 <<" Austrian Schilling\n";
	cout << setprecision(2) << setw(10) << setfill('*') << setiosflags(ios::fixed) << brit_Pn2     <<" British Pound\n";
	cout << setprecision(2) << setw(10) << setfill('*') << setiosflags(ios::fixed) << belg_Frc2    <<" Belgian Franc\n";
	cout << setprecision(2) << setw(10) << setfill('*') << setiosflags(ios::fixed) << dan_Kronr2   <<" Danish Kroner\n";
	cout << setprecision(2) << setw(10) << setfill('*') << setiosflags(ios::fixed) << fnch_Frc2    <<" French Franc\n";
	cout << setprecision(2) << setw(10) << setfill('*') << setiosflags(ios::fixed) << grm_Mrk2     <<" German Mark\n";
	cout << setprecision(2) << setw(10) << setfill('*') << setiosflags(ios::fixed) << itl_Lira2    <<" Italian Lira\n";
	cout << setprecision(2) << setw(10) << setfill('*') << setiosflags(ios::fixed) << neth_Gldrs2  <<" Netherlands Guilders\n";
	cout << setprecision(2) << setw(10) << setfill('*') << setiosflags(ios::fixed) << prt_Escdo2   <<" Portuguese Escudo\n";
	cout << setprecision(2) << setw(10) << setfill('*') << setiosflags(ios::fixed) << spnsh_Pest2  <<" Spanish Pesetas\n\n";


	cout <<" Master, your commission is $"<< setprecision(2)								//display commission... 
		 << setiosflags(ios::fixed) << payment<<" .\tHave a GREAT day!\n";					// to 2 decimal places
																														
	return 0;									// million dollar finish(i.e. clean)
}
