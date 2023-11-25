<%@ Register TagPrefix="uc1" TagName="footer" Src="footer.ascx" %>
<%@ Register TagPrefix="uc1" TagName="ClinicHeader" Src="ClinicHeader.ascx" %>
<%@ Page Language="vb" AutoEventWireup="false" Codebehind="AppointmentDetails.aspx.vb" Inherits="cis3310.AppointmentDetails"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<HEAD>
		<title>AppointmentDetails</title>
		<meta name="GENERATOR" content="Microsoft Visual Studio .NET 7.1">
		<meta name="CODE_LANGUAGE" content="Visual Basic .NET 7.1">
		<meta name="vs_defaultClientScript" content="JavaScript">
		<meta name="vs_targetSchema" content="http://schemas.microsoft.com/intellisense/ie5">
		<link href="Styles.css" rel="stylesheet" type="text/css">
	</HEAD>
	<body bgColor="linen">
		<form id="Form1" method="post" runat="server">
			<P>
				<uc1:ClinicHeader id="ClinicHeader1" runat="server"></uc1:ClinicHeader></P>
			<P>Appointment Details</P>
			<P>Date:
				<asp:Label id="txtDate" runat="server" Font-Bold="True"></asp:Label>&nbsp; 
				Time:
				<asp:Label id="txtTime" runat="server" Font-Bold="True"></asp:Label></P>
			<P>Patient Name:
				<asp:TextBox id="txtName" runat="server" CssClass="TextBox"></asp:TextBox>&nbsp;
				<asp:Button id="btnSearch" runat="server" Text="Search" CssClass="Button"></asp:Button></P>
			<P>Reason for Appointment:
				<asp:TextBox id="txtReason" runat="server" CssClass="TextBox"></asp:TextBox></P>
			<P>
				<asp:Button id="Button1" runat="server" CssClass="Button" Text="Schedule Appointment"></asp:Button>&nbsp;
				<asp:Button id="btnCancel" runat="server" CssClass="Button" Text="Cancel"></asp:Button></P>
			<P>
				<uc1:footer id="Footer1" runat="server"></uc1:footer></P>
		</form>
	</body>
</HTML>
