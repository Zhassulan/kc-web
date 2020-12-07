<?xml version="1.0" encoding="Windows-1251"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:decimal-format decimal-separator="." grouping-separator=","/>
  <xsl:template match="/">
    <html>
      <head>
        <title>
          <xsl:value-of select="/Receiver/Report/@Desc"/>:
          <xsl:value-of select="/Receiver/@Id"/>��
          <xsl:value-of select="/Receiver/@DateTo"/>
        </title>
        <style>

          td
          {
          padding-top:1px;
          padding-right:3px;
          padding-bottom:1px;
          padding-left:3px;
          white-space:nowrap;
          }

          .np
          {
          padding-top:0px;
          padding-right:0px;
          padding-bottom:1px;
          padding-left:0px;
          }

          .sign1
          {
          font-size:7.0pt;
          font-weight:100;
          font-family:"Arial CYR", sans-serif;
          color:gray;
          text-align:center;
          vertical-align:bottom;
          white-space:normal;
          letter-spacing:2pt;
          }

          .sign2
          {
          font-size:7.0pt;
          font-weight:100;
          font-family:"Arial CYR", sans-serif;
          color:gray;
          text-align:center;
          vertical-align:top;
          white-space:normal;
          letter-spacing:2pt;
          }

          .sign3
          {
          color:gray;
          text-align:justify;
          vertical-align:top;
          border-top:.5pt solid gray;
          }

          .sign4
          {
          color:gray;
          text-align:left;
          vertical-align:middle;
          white-space:normal;
          }

          .sign5
          {
          color:gray;
          text-align:right;
          vertical-align:middle;
          white-space:normal;
          }

          .hdr01
          {
          font-size:8.0pt;
          font-weight:100;
          font-family:"Arial CYR", sans-serif;
          color:#315D84;
          text-align:center;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          background:#E7F2F4;
          white-space:normal;
          }

          .dat01
          {
          font-size:7.0pt;
          font-weight:700;
          font-family:"Courier New CYR", monospace;
          letter-spacing:.5pt;
          text-align:center;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          }

          .dat01_l
          {
          font-size:7.0pt;
          font-weight:700;
          font-family:"Courier New CYR", monospace;
          letter-spacing:.5pt;
          text-align:left;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          }

          .dat01_r
          {
          font-size:7.0pt;
          font-weight:700;
          font-family:"Courier New CYR", monospace;
          letter-spacing:.5pt;
          text-align:right;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          }

          .dat02
          {
          font-size:7.0pt;
          font-weight:700;
          font-family:"Courier New CYR", monospace;
          letter-spacing:.5pt;
          text-align:left;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          }

          .dat02L
          {
          font-size:8.0pt;
          font-weight:700;
          font-family:"Courier New CYR", monospace;
          letter-spacing:.5pt;
          text-align:left;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          }

        </style>
      </head>
      <body>
        <xsl:apply-templates/>
      </body>
    </html>

  </xsl:template>
  <xsl:template match="Receiver">
    <xsl:element name="table">
      <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>
      <tr>
        <td colSpan="14" class="np">
          <xsl:element name="table">
            <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>
            <col/>
            <col width="100%"/>
            <col/>
            <tr>
              <td class="sign5" rowspan="2">
                <img src="https://kc-ets.kz/docs/schema/ets001.jpg" width="105" height="25" alt="submit"/>
              </td>
              <td class="sign1">������ �������� ������� � ����������� ���� �
�������� ����������� �������� ��������</td>
              <td class="sign5" rowspan="2">
                <img src="https://kc-ets.kz/docs/schema/ets001.jpg" width="105" height="25" alt="submit"/>
              </td>
            </tr>
            <tr>
              <td class="sign2">������������ �������� "�������� ����� "�����������
�������� �������"</td>
            </tr>
            <tr height="4">
              <td class="np"/>
            </tr>
            <tr height="20">
              <td class="sign3" colspan="3"/>
            </tr>
          </xsl:element>
        </td>
      </tr>
      <tr>
        <td colSpan="14" class="np">
          <xsl:element name="table">
            <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>
            <col width="20%"/>
            <col/>
            <col width="100%"/>
            <col/>
            <col/>
            <tr>
              <td class="hdr01" colspan="5">����������� �������� "��������
����� "����������� �������� �������"</td>
            </tr>
            <tr>
              <td class="dat02L" colspan="5">
                <xsl:value-of select="Report/@Desc"/>
              </td>
            </tr>
            <tr>
              <td class="hdr01">���� ������</td>
              <td class="dat02">
                <xsl:value-of select="@DateTo"/>
              </td>
              <td class="dat02"/>
              <td class="hdr01">�����������</td>
              <td class="dat02">
                <xsl:value-of select="@DateRpt"/>
              </td>
            </tr>
          </xsl:element>
        </td>
      </tr>
      <tr height="4">
        <td class="np"/>
      </tr>

      <tr>
         <td colSpan="9" class="np">
          <xsl:element name="table">
            <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>
            <tr>
              <td class="hdr01">��� �������</td>
              <td class="hdr01">������������ �������</td>
              <td class="hdr01">��� �������</td>
              <td class="hdr01">���������� ������</td>
            </tr>
            <xsl:apply-templates select="Legals/Legal"/>
          </xsl:element>
        </td>

        <td colSpan="1" class="np"/>
        <td colSpan="9" class="np">
          <xsl:element name="table">
            <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>
            <tr>
              <td class="hdr01">��������� ������</td>
              <td class="hdr01">������ � �����</td>
              <td class="hdr01">����� � ������</td>
              <td class="hdr01">���������� ������</td>
            </tr>
            <xsl:apply-templates select="Total/Category"/>
            <xsl:apply-templates select="Total/Subtotal"/>
          </xsl:element>
        </td>
      </tr>
      <tr height="8">
        <td class="np"/>
      </tr>
      <tr height="8">
        <td class="np"/>
      </tr>

     <tr>
      <!-- td class="hdr01">����� �\�</td -->
      <td class="hdr01">����� ������</td>
      <td class="hdr01">��� ������</td>
      <td class="hdr01">���� � ����� ����������� ������</td>
      <td class="hdr01">���� ���������� ������</td>
      <td class="hdr01">���-�� ������, � ��. ���. ������</td>
      <td class="hdr01">������ ������</td>
      <td class="hdr01">���� �� ������� ������</td>
      <td class="hdr01">����� ������</td>
      <td class="hdr01">��� ����������</td>
      <td class="hdr01">������ ����������</td>
      <td class="hdr01">Memo ����������</td>
      <td class="hdr01">��� ��������</td>
      <td class="hdr01">������ ��������</td>
      <td class="hdr01">Memo ��������</td>
    </tr>

    <xsl:apply-templates select="Issue/Contract"/>

      <tr height="20">
        <td class="np"/>
      </tr>

      <tr>
        <td colSpan="13" class="np">

        <xsl:element name="table">
          <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>

          <tr>
            <td colSpan="1" class="hdr01">��� ������</td>
            <td colSpan="1" class="hdr01">�������</td>
            <td colSpan="1" class="hdr01">��� ������</td>
            <td colSpan="1" class="hdr01">������������ ������</td>
            <td colSpan="1" class="hdr01">������� ��������� ������</td>
          </tr>

          <xsl:apply-templates select="Issue"/>

        </xsl:element>
      </td>
    </tr>
    </xsl:element>
  </xsl:template>


  <xsl:template match="Issue">
     <tr>

      <td colSpan="1" class="dat01_r">
        <xsl:choose>
          <xsl:when test="@Type[.='GRAIN']">
            <xsl:text>�����</xsl:text>
          </xsl:when>
          <xsl:when test="@Type[.='RAW']">
            <xsl:text>�����</xsl:text>
          </xsl:when>
          <xsl:when test="@Type[.='OIL']">
            <xsl:text>�����</xsl:text>
          </xsl:when>
          <xsl:when test="@Type[.='METAL']">
            <xsl:text>������</xsl:text>
          </xsl:when>
          <xsl:when test="@Type[.='PRODUCT']">
            <xsl:text>��������</xsl:text>
          </xsl:when>
          <xsl:when test="@Type[.='DISTIL']">
            <xsl:text>�������������</xsl:text>
          </xsl:when>
          <xsl:otherwise>
        <xsl:value-of select="@Type"/>
          </xsl:otherwise>
        </xsl:choose>
      </td>

      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@Lstg"/>
      </td>

      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@Code"/>
      </td>

      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@Name"/>
      </td>

      <td colSpan="1" class="dat01_r">
        <xsl:choose>
          <xsl:when test="@Unit[.='TON']">
            <xsl:text>�����</xsl:text>
          </xsl:when>
          <xsl:otherwise>
        <xsl:value-of select="@Unit"/>
          </xsl:otherwise>
        </xsl:choose>
      </td>

    </tr>

  </xsl:template>

  <xsl:template match="Issue/Contract">
   <tr>
      <!--  td colSpan="1" class="dat01_l">
      < xsl:value-of select="@RecNum"/ >
      </td -->
      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@Number"/>
      </td>
      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="../@Code"/>
      </td>
      <td colSpan="1" class="dat01">
        <xsl:value-of select="@Moment"/>
      </td>
      <td colSpan="1" class="dat01">
        <xsl:value-of select="Settlement/@DeliveryDate"/>
      </td>
      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="@Qty"/>
      </td>
      <td colSpan="1" class="dat01">
        <xsl:value-of select="@Currency"/>
      </td>
      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="format-number(@Price,'#.00')"/>
      </td>
      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="format-number(@Amt,'#.00')"/>
      </td>
      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@BuyerCode"/>
      </td>
      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@BuyerClient"/>
      </td>
      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@BuyerMemo"/>
      </td>
      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@SellerCode"/>
      </td>
      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@SellerClient"/>
      </td>
      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@SellerMemo"/>
      </td>
    </tr>
  </xsl:template>


  <xsl:template match="Legals/Legal">
    <tr>
      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@Code"/>
      </td>
      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@FullName"/>
      </td>
      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@Inn"/>
      </td>
      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="@DealCount"/>
      </td>
    </tr>
  </xsl:template>

  <xsl:template match="Total/Category">
    <tr>
      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@Type"/>
      </td>
      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="format-number(@Amount,'#.00')"/>
      </td>
      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="format-number(@Qty,'#')"/>
      </td>
      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="@TotNum"/>
      </td>
    </tr>
  </xsl:template>

  <xsl:template match="Total/Subtotal">
    <tr>
      <td colSpan="1" class="hdr01">�����</td>
      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="format-number(@Amount,'#.00')"/>
      </td>
      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="format-number(@Qty,'#')"/>
      </td>
      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="@TotNum"/>
      </td>
    </tr>
  </xsl:template>


</xsl:stylesheet>
