<%@ Register TagPrefix="uc1" TagName="footer" Src="footer.ascx" %>
<%@ Register TagPrefix="uc1" TagName="ClinicHeader" Src="ClinicHeader.ascx" %>
<%@ Page Language="vb" AutoEventWireup="false" Codebehind="PatientDetails.aspx.vb" Inherits="cis3310.PatientDetails"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<HEAD>
		<title>PatientDetails</title>
		<meta content="Microsoft Visual Studio .NET 7.1" name="GENERATOR">
		<meta content="Visual Basic .NET 7.1" name="CODE_LANGUAGE">
		<meta content="JavaScript" name="vs_defaultClientScript">
		<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
		<LINK href="Styles.css" type="text/css" rel="stylesheet">
	</HEAD>
	<body>
		<form id="Form1" method="post" runat="server">
			<P><uc1:clinicheader id="ClinicHeader1" runat="server"></uc1:clinicheader></P>
			<P><STRONG>Patient Details</STRONG></P>
			<P><STRONG>Search for Patient:
					<asp:textbox id="TextBox1" runat="server" CssClass="TextBox"></asp:textbox>&nbsp;
					<asp:button id="btnSearch" runat="server" Text="Search" CssClass="Button"></asp:button></STRONG></P>
			<P>
				<TABLE id="Table1" style="WIDTH: 544px; HEIGHT: 477px" cellSpacing="1" cellPadding="1"
					width="544" border="0">
					<TR>
						<TD style="WIDTH: 221px">SSN</TD>
						<TD style="WIDTH: 236px"><asp:textbox id="txtSSN1" runat="server" Width="30px" CssClass="TextBox">123</asp:textbox>-
							<asp:textbox id="txtSSN2" runat="server" Width="20px" CssClass="TextBox">45</asp:textbox>-
							<asp:textbox id="txtSSN3" runat="server" Width="40px" CssClass="TextBox">6789</asp:textbox></TD>
						<TD align="center"><asp:button id="btnInsurance" runat="server" Width="125px" Text="Insurance Info" CssClass="Button"></asp:button></TD>
					</TR>
					<TR>
						<TD style="WIDTH: 221px">First Name</TD>
						<TD style="WIDTH: 236px"><asp:textbox id="txtFirstName" runat="server" CssClass="TextBox">Michael</asp:textbox></TD>
						<TD align="center"><asp:button id="btnHistory" runat="server" Width="125px" Text="Medical History" CssClass="Button"></asp:button></TD>
					</TR>
					<TR>
						<TD style="WIDTH: 221px">Middle Name</TD>
						<TD style="WIDTH: 236px"><asp:textbox id="txtMiddleName" runat="server" CssClass="TextBox">James</asp:textbox></TD>
						<TD></TD>
					</TR>
					<TR>
						<TD style="WIDTH: 221px">Last Name</TD>
						<TD style="WIDTH: 236px"><asp:textbox id="txtLastName" runat="server" CssClass="TextBox">England</asp:textbox></TD>
						<TD></TD>
					</TR>
					<TR>
						<TD style="WIDTH: 221px">Address 1</TD>
						<TD style="WIDTH: 236px"><asp:textbox id="txtAddress1" runat="server" CssClass="TextBox">624 Lincoln Court Ave</asp:textbox></TD>
						<TD></TD>
					</TR>
					<TR>
						<TD style="WIDTH: 221px">Address 2</TD>
						<TD style="WIDTH: 236px"><asp:textbox id="txtAddress2" runat="server" CssClass="TextBox"></asp:textbox></TD>
						<TD></TD>
					</TR>
					<TR>
						<TD style="WIDTH: 221px">City</TD>
						<TD style="WIDTH: 236px"><asp:textbox id="txtCity" runat="server" CssClass="TextBox">Atlanta</asp:textbox></TD>
						<TD></TD>
					</TR>
					<TR>
						<TD style="WIDTH: 221px">State</TD>
						<TD style="WIDTH: 236px"><asp:dropdownlist id="txtState" runat="server">
								<asp:ListItem Value="AL">Alabama</asp:ListItem>
								<asp:ListItem Value="FL">Florida</asp:ListItem>
								<asp:ListItem Value="GA" Selected="True">Georgia</asp:ListItem>
							</asp:dropdownlist></TD>
						<TD></TD>
					</TR>
					<TR>
						<TD style="WIDTH: 221px">Zip</TD>
						<TD style="WIDTH: 236px"><asp:textbox id="TextBox6" runat="server" Width="60px" CssClass="TextBox">30329</asp:textbox></TD>
						<TD></TD>
					</TR>
					<TR>
						<TD style="WIDTH: 221px">Home Phone</TD>
						<TD style="WIDTH: 236px"><asp:textbox id="TextBox7" runat="server" CssClass="TextBox"></asp:textbox></TD>
						<TD></TD>
					</TR>
					<TR>
						<TD style="WIDTH: 221px">Work Phone</TD>
						<TD style="WIDTH: 236px"><asp:textbox id="TextBox8" runat="server" CssClass="TextBox"></asp:textbox></TD>
						<TD></TD>
					</TR>
					<TR>
						<TD style="WIDTH: 221px">Emergency Contact Name</TD>
						<TD style="WIDTH: 236px"><asp:textbox id="TextBox9" runat="server" CssClass="TextBox"></asp:textbox></TD>
						<TD></TD>
					</TR>
					<TR>
						<TD style="WIDTH: 221px">Emergency Contact Phone</TD>
						<TD style="WIDTH: 236px"><asp:textbox id="TextBox10" runat="server" CssClass="TextBox"></asp:textbox></TD>
						<TD></TD>
					</TR>
					<TR>
						<TD style="WIDTH: 221px">Gender</TD>
						<TD style="WIDTH: 236px"><asp:dropdownlist id="txtGender" runat="server">
								<asp:ListItem Value="Select Gender" Selected="True">Select Gender</asp:ListItem>
								<asp:ListItem Value="M">Male</asp:ListItem>
								<asp:ListItem Value="F">Female</asp:ListItem>
							</asp:dropdownlist></TD>
						<TD></TD>
					</TR>
					<TR>
						<TD style="WIDTH: 221px">Birth Date</TD>
						<TD style="WIDTH: 236px"><asp:textbox id="txtBirthMonth" runat="server" Width="20px" CssClass="TextBox"></asp:textbox>-
							<asp:textbox id="txtBirthDay" runat="server" Width="20px" CssClass="TextBox"></asp:textbox>-
							<asp:textbox id="txtBirthYear" runat="server" Width="45px" CssClass="TextBox"></asp:textbox></TD>
						<TD></TD>
					</TR>
					<TR>
						<TD style="WIDTH: 221px"></TD>
						<TD style="WIDTH: 236px"></TD>
						<TD></TD>
					</TR>
					<TR>
						<TD width="100%" colSpan="3"><asp:button id="btnSave" runat="server" Width="120px" Text="Save Changes" CssClass="button"></asp:button>&nbsp;
							<asp:button id="btnCancel" runat="server" Width="120px" Text="Cancel Changes" CssClass="Button"></asp:button></TD>
					</TR>
				</TABLE>
			</P>
			<P><uc1:footer id="Footer1" runat="server"></uc1:footer></P>
		</form>
	</body>
</HTML>
