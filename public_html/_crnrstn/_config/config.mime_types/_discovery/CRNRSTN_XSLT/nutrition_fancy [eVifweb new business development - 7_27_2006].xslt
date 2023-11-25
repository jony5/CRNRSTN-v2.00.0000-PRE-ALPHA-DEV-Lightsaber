<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	version="1.0">

<xsl:output method="html" indent="yes"/>

<xsl:template match="nutrition">
<html>
<head>
<style type="text/css">
h2 { font-size: 200%; }
h3 {
	font-size: 150%;
}
h3.title {
	font-style: italic;
	text-align: right;
	margin-top: 0.5em;
	border-top: 2px solid navy;
	padding-top: 0.5em;
}

.bargraph {
	position: relative;
	width: 101px;
	height: 15px;
	border: 1px solid black;
}

.colorbar {
	position: relative;
	left: 1px;
	top: 1px;
	height: 13px;
}

</style>

<title>How Healthy Is It?</title>
</head>
<body>
<h2 align="center">How Healthy Is It?</h2>

<h3 class="title">Healthy: Fitness gurus love you.</h3>
<xsl:apply-templates select="food[calories/@fat div calories/@total &lt; 0.33]">
	<xsl:sort select="calories/@fat div calories/@total"/>
</xsl:apply-templates>

<h3 class="title">Medium: You could do worse than eat it.</h3>

<xsl:apply-templates select="food[calories/@fat div calories/@total &gt; 0.33 and calories/@fat div calories/@total &lt; 0.66]">
	<xsl:sort select="calories/@fat div calories/@total"/>
</xsl:apply-templates>

<h3 class="title">Unhealthy: I am become Death, Destroyer of Worlds.</h3>

<xsl:apply-templates select="food[calories/@fat div calories/@total &gt; 0.66]">
	<xsl:sort select="calories/@fat div calories/@total"/>
</xsl:apply-templates>
</body>
</html>
</xsl:template>

<xsl:template match="food">
<xsl:variable name="pct" select="calories/@fat div calories/@total"/>
<h3><xsl:value-of select="name"/><xsl:text> from </xsl:text>
	<xsl:value-of select="mfr"/></h3>
<p>In each serving of <xsl:value-of select="serving"/>
<xsl:text> </xsl:text><xsl:value-of select="serving/@units"/>,
<span>
	<xsl:if test="$pct &gt; 0.66">
		<xsl:attribute name="style">color: red;</xsl:attribute>
	</xsl:if>
	<xsl:value-of select="format-number($pct, '###%')"/>
</span> of the <xsl:value-of select="calories/@total"/> calories 
come from fat.</p>

<table border="0">
<xsl:call-template name="info-row">
	<xsl:with-param name="msg">Total Fat</xsl:with-param>
	<xsl:with-param name="node" select="total-fat"/>
</xsl:call-template>

<xsl:call-template name="info-row">
	<xsl:with-param name="msg">Saturated Fat</xsl:with-param>
	<xsl:with-param name="node" select="saturated-fat"/>
</xsl:call-template>

<xsl:call-template name="info-row">
	<xsl:with-param name="msg">Cholesterol</xsl:with-param>
	<xsl:with-param name="node" select="cholesterol"/>
</xsl:call-template>

<xsl:call-template name="info-row">
	<xsl:with-param name="msg">Sodium</xsl:with-param>
	<xsl:with-param name="node" select="sodium"/>
</xsl:call-template>
</table>
</xsl:template>

<xsl:template name="info-row">
<xsl:param name="msg"/>
<xsl:param name="node"/>
<xsl:variable name="pct" select="round(100 * $node div /nutrition/daily-values/*[name(.)=name($node)])"/>
<tr><td align="right"><b><xsl:value-of select="$msg"/></b></td>
<td align="right">
<b><xsl:value-of select="$node"/><xsl:value-of select="/nutrition/daily-values/*[name(.)=name($node)]/@units"/></b></td>
<td>
<div class="bargraph">
	<div class="colorbar">
		<xsl:choose>
		<xsl:when test="$pct &lt; 50">
			<xsl:attribute name="style">background-color:green; width:<xsl:value-of select="$pct"/></xsl:attribute>
		</xsl:when>
		<xsl:otherwise>
			<xsl:attribute name="style">background-color:red; width:<xsl:value-of select="$pct"/></xsl:attribute>
		</xsl:otherwise>
		</xsl:choose>
	</div>
</div>
</td>
<td align="right">
<xsl:text> </xsl:text><xsl:value-of select="$pct"/><xsl:text>%</xsl:text>
</td>
</tr>
</xsl:template>

</xsl:stylesheet>

