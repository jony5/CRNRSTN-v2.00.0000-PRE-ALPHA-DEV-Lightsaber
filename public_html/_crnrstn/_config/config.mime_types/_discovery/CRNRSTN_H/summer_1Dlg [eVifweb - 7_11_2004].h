// summer_1Dlg.h : header file
//

#pragma once


// Csummer_1Dlg dialog
class Csummer_1Dlg : public CDialog
{
// Construction
public:
	Csummer_1Dlg(CWnd* pParent = NULL);					// standard constructor

// Dialog Data
	enum { IDD = IDD_SUMMER_1_DIALOG };

	protected:
	virtual void DoDataExchange(CDataExchange* pDX);	// DDX/DDV support


// Implementation
protected:
	HICON m_hIcon;

	// Generated message map functions
	virtual BOOL OnInitDialog();
	afx_msg void OnSysCommand(UINT nID, LPARAM lParam);
	afx_msg void OnPaint();
	afx_msg HCURSOR OnQueryDragIcon();
	DECLARE_MESSAGE_MAP()
public:
	afx_msg void OnBnClickedOk();
};
