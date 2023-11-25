<%@ Page Language="vb" AutoEventWireup="false" Codebehind="InsuranceInformation.aspx.vb" Inherits="cis3310.InsuranceInformation"%>
<%@ Register TagPrefix="uc1" TagName="ClinicHeader" Src="ClinicHeader.ascx" %>
<%@ Register TagPrefix="uc1" TagName="footer" Src="footer.ascx" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<HEAD>
		<title>InsuranceInformation</title>
		<meta name="GENERATOR" content="Microsoft Visual Studio .NET 7.1">
		<meta name="CODE_LANGUAGE" content="Visual Basic .NET 7.1">
		<meta name="vs_defaultClientScript" content="JavaScript">
		<meta name="vs_targetSchema" content="http://schemas.microsoft.com/intellisense/ie5">
		<link href="Styles.css" rel="stylesheet" type="text/css">
	</HEAD>
	<body>
		<form id="Form1" method="post" runat="server">
			<P>
				<uc1:ClinicHeader id="ClinicHeader1" runat="server"></uc1:ClinicHeader></P>
			<P><STRONG>Patient Insurance Information</STRONG></P>
			<P>Patient: <STRONG>England, Michael</STRONG></P>
			<P>
				<TABLE id="Table1" cellSpacing="1" cellPadding="1" border="0">
					<TR>
						<TD>Insurance Company</TD>
						<TD>
							<asp:TextBox id="TextBox1" runat="server" CssClass="TextBox">Humana</asp:TextBox></TD>
					</TR>
					<TR>
						<TD>Member ID Number</TD>
						<TD>
							<asp:TextBox id="TextBox3" runat="server" CssClass="TextBox">123-45-6789</asp:TextBox></TD>
					</TR>
					<TR>
						<TD>Group Number</TD>
						<TD>
							<asp:TextBox id="TextBox4" runat="server" CssClass="TextBox">40533</asp:TextBox></TD>
					</TR>
					<TR>
						<TD>Telephone Number</TD>
						<TD>
							<asp:TextBox id="TextBox5" runat="server" CssClass="TextBox">(800) 555-1212</asp:TextBox></TD>
					</TR>
					<TR>
						<TD>Claims Address</TD>
						<TD>
							<asp:TextBox id="TextBox6" runat="server" Width="300px" CssClass="TextBox">123 Main Street, Anytown, GA 30303</asp:TextBox></TD>
					</TR>
					<TR>
						<TD>Date Verified</TD>
						<TD>
							<asp:TextBox id="txtBirthMonth" runat="server" Width="20px" CssClass="TextBox">10</asp:TextBox>-
							<asp:TextBox id="txtBirthDay" runat="server" Width="20px" CssClass="TextBox">26</asp:TextBox>-
							<asp:TextBox id="txtBirthYear" runat="server" Width="45px" CssClass="TextBox">2003</asp:TextBox></TD>
					</TR>
					<TR>
						<TD>Co Pay Amount&nbsp;&nbsp;&nbsp;&nbsp; $</TD>
						<TD>
							<asp:TextBox id="TextBox2" runat="server" Width="40px" CssClass="TextBox">15</asp:TextBox></TD>
					</TR>
				</TABLE>
			</P>
			<P>
				<asp:Button id="btnSave" runat="server" Width="120px" CssClass="button" Text="Save Changes"></asp:Button>&nbsp;
				<asp:Button id="btnCancel" runat="server" Width="120px" CssClass="Button" Text="Cancel Changes"></asp:Button></P>
			<P>
				<uc1:footer id="Footer1" runat="server"></uc1:footer></P>
		</form>
	</body>
</HTML>
