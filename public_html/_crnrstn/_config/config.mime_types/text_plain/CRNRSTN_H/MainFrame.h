/*
File Name:				MainFrame.h
Programmer:				Jonathan Harris
Last Modified:			3.15.203
*/

#include <afxwin.h>

class CMainFrame : public CFrameWnd
{
private:
	CMenu menu;
	// private member variables of window
public:
	CMainFrame();		// Constructor

	// window message handling function
	afx_msg void OnPaint();

//File
	//new
	afx_msg void DO_ID_NEW_ORDERFORM();				//103
	afx_msg void DO_ID_NEW_ORDERENTRY();			//104
	//open
	afx_msg void DO_ID_OPEN_ORDER();				//108
	afx_msg void DO_ID_RECENT_SOMERECENTFILES(); 	//107

	//save
	afx_msg void DO_ID_FILE_SAVE109();              //109
	// exit
	afx_msg void DO_ID_FILE_EXIT();                 //113
	afx_msg void DO_ID_FILE_CLOSE142();             //142
//Edit
	afx_msg void DO_ID_EDIT_ADD();					//154
	afx_msg void DO_ID_EDIT_MODIFY();				//116
	afx_msg void DO_ID_EDIT_DELETE();				//117
//Search
	//For Customer
	afx_msg void DO_ID_FORCUSTOMER_BYCUSTOMERNUMBER();//124
	afx_msg void DO_ID_FORCUSTOMER_BYNAME();       	  //122
	afx_msg void DO_ID_FORCUSTOMER_BYCUSTOMERSTATUS();//125
	afx_msg void DO_ID_BYTRANSACTION_NUMBER();        //131
	afx_msg void DO_ID_BYTRANSACTION_DATE();       	  //132
	afx_msg void DO_ID_BYTRANSACTION_PRICE();	      //133
	afx_msg void DO_ID_BYTRANSACTIONNUMBER_NUMBER();  //134
	afx_msg void DO_ID_BYTRANSACTIONNUMBER_DATE();    //135
	afx_msg void DO_ID_BYCUSTOMER_NAME();             //136
	afx_msg void DO_ID_BYCUSTOMER_ID();               //137
	afx_msg void DO_ID_FORORDER_BYPRICE();            //129...by price

	DECLARE_MESSAGE_MAP();
};
