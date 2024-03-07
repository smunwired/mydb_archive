<!--
/* Standard CSS for div tables.  By Tom Haws
 * Overview:
 * 1. a row is a box element that wants all its children to be
 *    arranged in a (horizontal) row
 *    and is itself a new line rather than a continuation of a line.
 * 2. a column is a box element that wants all its children to be
 *    arranged in a (vertical) column
 *    and is itself a continuation of a line unless it is
 *    the first column in a row.
 *
 * */
/* Any child of a row AND any column class that is anything but first-child
 * represents another column continuing the same row
 * */
-->
<head>
<style>
.row>*, .column
{
    float: left;
}
/* Every first child of a row and every column that is a first child of any parent
 * represents a new row (first column)
 * */
.row>*:first-child, .column:first-child
{
    clear: both;
    float: left;
}
/* All rows and all children of a column are a new line.
 * */
.row, .column>*
{
    clear: both;
    float: left;

}
</style>
</head>
<h1>
Here's how I'd do your little example:
</h1>
<div class="row">
    <div>left1</div>
    <div>right1</div>
</div>
<div class="row">
    <div>left2</div>
    <div>right2</div>
</div>