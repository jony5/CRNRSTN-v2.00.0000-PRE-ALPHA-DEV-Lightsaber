<%@ Register TagPrefix="uc1" TagName="ClinicHeader" Src="ClinicHeader.ascx" %>
<%@ Page Language="vb" AutoEventWireup="false" Codebehind="Index.aspx.vb" Inherits="cis3310.ClinicSystemMenu"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<HEAD>
		<title>ClinicSystemMenu</title>
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
			<P>&nbsp;</P>
			<P align="center"><FONT size="4">Main Menu</FONT></P>
			<FONT size="4">
				<P align="center">
					<asp:Button id="btnSchedule" runat="server" Text="Appointment Schedule" CssClass="Button" Width="225px"></asp:Button></P>
			</FONT><FONT size="4">
				<P align="center">
					<asp:Button id="btnPatient" runat="server" Text="Patient Information" CssClass="Button" Width="225px"></asp:Button></P>
			</FONT>
			<P align="center">
				<asp:Button id="btnHistory" runat="server" Text="Maintain History Questions" CssClass="Button"
					Width="225px"></asp:Button></P>
		</form>
	</body>
</HTML>
