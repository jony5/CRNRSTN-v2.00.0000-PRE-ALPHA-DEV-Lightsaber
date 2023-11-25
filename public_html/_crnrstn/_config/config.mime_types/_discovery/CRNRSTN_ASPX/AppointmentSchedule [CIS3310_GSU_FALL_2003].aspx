<%@ Register TagPrefix="uc1" TagName="ClinicHeader" Src="ClinicHeader.ascx" %>
<%@ Register TagPrefix="uc1" TagName="footer" Src="footer.ascx" %>
<%@ Page Language="vb" AutoEventWireup="false" Codebehind="AppointmentSchedule.aspx.vb" Inherits="cis3310.AppointmentSchedule"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<HEAD>
		<title>AppointmentSchedule</title>
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
			<P>Select Date:
				<asp:TextBox id="txtMonth" runat="server" Width="20px"></asp:TextBox>&nbsp;/
				<asp:TextBox id="txtDay" runat="server" Width="20px"></asp:TextBox>&nbsp;/
				<asp:TextBox id="txtYear" runat="server" Width="35px"></asp:TextBox>&nbsp;
				<asp:Button id="Button1" runat="server" Text="Change Date" CssClass="Button"></asp:Button></P>
			<TABLE id="Table1" cellSpacing="1" cellPadding="1" width="100%" border="1">
				<TR>
					<TD style="WIDTH: 65px">
						<P align="center"><STRONG>Time</STRONG></P>
					</TD>
					<TD style="WIDTH: 237px">
						<P align="center"><STRONG>Patient Name</STRONG></P>
					</TD>
					<TD>
						<P align="center"><STRONG>Reason</STRONG></P>
					</TD>
				</TR>
				<TR>
					<TD style="WIDTH: 65px">
						<P align="center">
							<asp:HyperLink id="link800" runat="server">8:00</asp:HyperLink></P>
					</TD>
					<TD style="WIDTH: 237px">&nbsp;</TD>
					<TD>&nbsp;</TD>
				</TR>
				<TR>
					<TD style="WIDTH: 65px" bgColor="aquamarine">
						<P align="center">8:15</P>
					</TD>
					<TD style="WIDTH: 237px" bgColor="aquamarine">
						<asp:HyperLink id="HyperLink1" runat="server" NavigateUrl="PatientDetails.aspx">England, Michael</asp:HyperLink></TD>
					<TD bgColor="aquamarine">Flu</TD>
				</TR>
				<TR>
					<TD style="WIDTH: 65px">
						<P align="center">8:30</P>
					</TD>
					<TD style="WIDTH: 237px">&nbsp;</TD>
					<TD>&nbsp;</TD>
				</TR>
				<TR>
					<TD style="WIDTH: 65px" bgColor="aquamarine">
						<P align="center">8:45</P>
					</TD>
					<TD style="WIDTH: 237px" bgColor="aquamarine">Hanif, Fatima</TD>
					<TD bgColor="aquamarine">Flu</TD>
				</TR>
				<TR>
					<TD style="WIDTH: 65px">
						<P align="center">9:00</P>
					</TD>
					<TD style="WIDTH: 237px">&nbsp;</TD>
					<TD>&nbsp;</TD>
				</TR>
				<TR>
					<TD style="WIDTH: 65px">
						<P align="center">9:15</P>
					</TD>
					<TD style="WIDTH: 237px">&nbsp;</TD>
					<TD bgColor="azure">&nbsp;</TD>
				</TR>
				<TR>
					<TD style="WIDTH: 65px">
						<P align="center">9:30</P>
					</TD>
					<TD style="WIDTH: 237px">&nbsp;</TD>
					<TD>&nbsp;</TD>
				</TR>
				<TR>
					<TD style="WIDTH: 65px">
						<P align="center">9:45</P>
					</TD>
					<TD style="WIDTH: 237px">&nbsp;</TD>
					<TD>&nbsp;</TD>
				</TR>
				<TR>
					<TD style="WIDTH: 65px">
						<P align="center">10:00</P>
					</TD>
					<TD style="WIDTH: 237px">&nbsp;</TD>
					<TD>&nbsp;</TD>
				</TR>
				<TR>
					<TD style="WIDTH: 65px">
						<P align="center">...</P>
					</TD>
					<TD style="WIDTH: 237px">
						<P align="center">...</P>
					</TD>
					<TD>
						<P align="center">...</P>
					</TD>
				</TR>
			</TABLE>
			<uc1:footer id="Footer1" runat="server"></uc1:footer>
		</form>
	</body>
</HTML>
