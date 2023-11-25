<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	version="1.0">

<xsl:output method="html" indent="yes"/>

<xsl:template match="nutrition">
<html>
<head>
<title>Nutrition Facts Summary</title>
</head>
<body>
<h2 align="center">Nutrition Facts Summary</h2>
<p>Here are summaries of nutrition facts for several foods.
They are based on these daily values:</p>
<xsl:apply-templates select="daily-values"/>
<hr width="80%" />
<xsl:apply-templates select="food"/>

</body>
</html>
</xsl:template>

<xsl:template match="daily-values">
<ul>
<li>Fat
	<ul>
	<li>Total: <xsl:value-of select="total-fat"/><xsl:value-of select="total-fat/@units"/></li>
	<li>Saturated: <xsl:value-of select="saturated-fat"/><xsl:value-of select="saturated-fat/@units"/></li>
	</ul>
</li>
<li>Cholesterol: <xsl:value-of select="cholesterol"/><xsl:value-of select="cholesterol/@units"/></li>
<li>Sodium: <xsl:value-of select="sodium"/><xsl:value-of select="sodium/@units"/></li>
<li>Carbohydrates: <xsl:value-of select="carb"/><xsl:value-of select="carb/@units"/></li>
<li>Fiber: <xsl:value-of select="fiber"/><xsl:value-of select="fiber/@units"/></li>
<li>Protein: <xsl:value-of select="protein"/><xsl:value-of select="protein/@units"/></li>
</ul>
</xsl:template>

<xsl:template match="food">
<h2><xsl:value-of select="name"/><xsl:text> </xsl:text>
	<i style="font-size:80%">(<xsl:value-of select="mfr"/>)</i></h2>
<p>Serving size: <xsl:value-of select="serving"/><xsl:value-of select="serving/@units"/><br />
Calories: <xsl:value-of select="calories/@total"/> /
Calories from fat: <xsl:value-of select="calories/@fat"/></p>
<table border="1">
<tr><th>Amount/Serving</th><th>%Daily Value</th></tr>
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

<xsl:call-template name="info-row">
	<xsl:with-param name="msg">Total Carbohydrates</xsl:with-param>
	<xsl:with-param name="node" select="carb"/>
</xsl:call-template>

<xsl:call-template name="info-row">
	<xsl:with-param name="msg">Dietary Fiber</xsl:with-param>
	<xsl:with-param name="node" select="fiber"/>
</xsl:call-template>

<xsl:call-template name="info-row">
	<xsl:with-param name="msg">Protein</xsl:with-param>
	<xsl:with-param name="node" select="protein"/>
</xsl:call-template>
</table>
<p align="center">
Vitamin A <xsl:value-of select="vitamins/a"/>%
<xsl:text disable-output-escaping="yes">&amp;middot;</xsl:text>
Vitamin C <xsl:value-of select="vitamins/c"/>%
<xsl:text disable-output-escaping="yes">&amp;middot;</xsl:text>
Calcium <xsl:value-of select="minerals/ca"/>%
<xsl:text disable-output-escaping="yes">&amp;middot;</xsl:text>
Iron <xsl:value-of select="minerals/fe"/>%
</p>
</xsl:template>

<xsl:template name="info-row">
<xsl:param name="msg"/>
<xsl:param name="node"/>
<tr><td><b><xsl:value-of select="$msg"/><xsl:text> </xsl:text>
<xsl:value-of select="$node"/><xsl:value-of select="/nutrition/daily-values/*[name(.)=name($node)]/@units"/></b>
</td>
<td align="right">
<xsl:value-of select="round(100 * $node div /nutrition/daily-values/*[name(.)=name($node)])"/><xsl:text>%</xsl:text>
</td></tr>
</xsl:template>

</xsl:stylesheet>
