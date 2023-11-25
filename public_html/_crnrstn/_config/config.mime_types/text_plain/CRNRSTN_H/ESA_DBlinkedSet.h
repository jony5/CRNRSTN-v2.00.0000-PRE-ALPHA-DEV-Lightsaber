// ESA_DBlinkedSet.h: interface of the CESA_DBlinkedSet class
//


#pragma once

// code generated on Monday, June 16, 2003, 9:41 AM

class CESA_DBlinkedSet : public CRecordset
{
public:
	CESA_DBlinkedSet(CDatabase* pDatabase = NULL);
	DECLARE_DYNAMIC(CESA_DBlinkedSet)

// Field/Param Data

// The string types below (if present) reflect the actual data type of the
// database field - CStringA for ANSI datatypes and CStringW for Unicode
// datatypes. This is to prevent the ODBC driver from performing potentially
// unnecessary conversions.  If you wish, you may change these members to
// CString types and the ODBC driver will perform all necessary conversions.
// (Note: You must use an ODBC driver version that is version 3.5 or greater
// to support both Unicode and these conversions).

	long	m_EMPINDEX;	//Autonumber for DB indexing
	CStringW	m_EMPNUMBER;	//Employee Identification Number
	CStringW	m_EMPFNAME;	//First name of employee
	CStringW	m_EMPLNAME;	//Last name of employee
	CStringW	m_ADDR1;	//Address line 1
	CStringW	m_ADDR2;	//Address line 2
	CStringW	m_ADDR3;	//Address line 3
	CStringW	m_CITY;	//Employee city of residence
	CStringW	m_ZIP;	//Zip code
	CStringW	m_PHONE;	//Phone number
	CStringW	m_EMAIL;	//Email address
	long	m_RADIOMGR;	//Activate manager employee type
	long	m_RADIOASSTMGR;	//Activate assistant manager employee type
	long	m_RADIOSALES;	//Activate sales associate employee type
	long	m_DRPBOXSTATE;	//Select state of residence
	long	m_DRPBOXSTATUS;	//Select employee status

// Overrides
	// Wizard generated virtual function overrides
	public:
	virtual CString GetDefaultConnect();	// Default connection string

	virtual CString GetDefaultSQL(); 	// default SQL for Recordset
	virtual void DoFieldExchange(CFieldExchange* pFX);	// RFX support

// Implementation
#ifdef _DEBUG
	virtual void AssertValid() const;
	virtual void Dump(CDumpContext& dc) const;
#endif

};

