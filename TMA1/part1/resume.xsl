<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"  xmlns:res ="http://aani.ca/resume">
<xsl:template match="/">
<html> 
<head>
    <link rel="stylesheet" href="../shared/styles.css" />
</head>
<body>
    <div class="resume-top">
        <xsl:for-each select="res:resume/general">
        <h1><xsl:value-of select="name"/></h1>
        <h4>email: <xsl:value-of select="email"/></h4>
        <h4>linkedin: <xsl:value-of select="linkedin"/></h4>
        </xsl:for-each>
    </div>

    <div class="content resume-body">
        <h1>Education</h1>
        <xsl:for-each select="res:resume/education/institute">
        <h2><xsl:value-of select="name"/></h2>
        <h4><xsl:value-of select="degree"/>, graduation date: <xsl:value-of select="graduated"/> </h4>
        </xsl:for-each>
        <h1>Work Experience</h1>
        <xsl:for-each select="res:resume/work/job">
        <h2><xsl:value-of select="title"/></h2>
        <h3><xsl:value-of select="company"/></h3>
        <h4><xsl:value-of select="start"/> to <xsl:value-of select="end"/> </h4>
        <ul>
        <xsl:for-each select="description">
            <li><xsl:value-of select="text()"/></li>
        </xsl:for-each>
        </ul>
        </xsl:for-each>
    </div>
</body>
</html>
</xsl:template>
</xsl:stylesheet>

