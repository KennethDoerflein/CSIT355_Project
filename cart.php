body{
    margin:0;
    font-size:26px;
    font-family: 'Open Sans';
}
head{
    padding:0;
}
.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a.right {
  float: right;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a.activeRight {
  float: right;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  background-color: #428bca;
  color: white;
}



.topnav a:hover {
  background-color: lightblue;
  color: black;
}

.topnav a.active {
  background-color: lightgray;
  color: black;
}

.login {
    background-color: white;
    text-decoration: none;
}
.login a.link{
    color:blue;
}
.login a:hover{
    color: green;
}
.sButton {
    border: none;
    text-decoration: none;
    background-color: black;
    color: white;
    display: inline-block;
    padding: 15px 60px;
    font-size: 16px;
    text-align: center;
    margin: 12px 2px;
    cursor: pointer;
    border-radius: 12px;
}
.login-form{
    padding: 10px;
    margin: 8px 0px;
}

#inputForm{
    padding: 10px;
    width: 40%;
    margin: 8px 0px;
}

.topnav .search-container {
  float: right;
}

.topnav input[type=text] {
  padding: 3px;
  margin-top: 12px;
  font-size: 12px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 3px;
  margin-top: 12px;
  margin-right: 16px;
  display: relative;
  background: #ddd;
  font-size: 12px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

.listedProducts{
  display: flex;
  margin-left: auto;
  margin-right: auto;
  flex-wrap: wrap;
  float:none;
}
.productCard{
  padding: 25px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 365px;
  /*margin-top: 20px;*/
  /*margin-bottom: 25px;*/
  /*margin-left: 103px;*/
  margin: 30px; 
  text-align: center;
  float:left;
}

.centerIMG{
    display: block;
    margin-left: auto; 
    margin-right: auto;
    max-width:22%;
}

.cartCard{
  padding: 25px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  /*max-width: 800;*/
  /*max-height: 400;*/
  /*margin-top: 20px;*/
  /*margin-bottom: 25px;*/
  /*margin-left: 103px;*/
  margin: 30px; 
  /*text-align: center;*/
  /*float:left;*/

}

.vl {
    border-left: 2px solid black;
    height: auto;
}

