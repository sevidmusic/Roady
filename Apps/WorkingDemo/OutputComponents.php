<?php

use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;

ini_set('display_errors', true);
require "../../vendor/autoload.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "Settings.php";

/**
 * Doctype
 */
$doctype = new OutputComponent(
    new Storable(
        DEMO_SITE_NAME . "WorkingDemoDoctype",
        DEMO_SITE_NAME,
        DEMO_SITE_NAME . "HtmlComponents"
    ),
    new Switchable(),
    new Positionable(0)
);
$doctype->import(['output' => '<!DOCTYPE html><html lang="en">']);

/**
 * Html <head>
 */
$htmlHead = new OutputComponent(
    new Storable(
        DEMO_SITE_NAME . "WorkingDemoHtmlHead",
        DEMO_SITE_NAME,
        DEMO_SITE_NAME . "HtmlComponents"
    ),
    new Switchable(),
    new Positionable(1)
);

$htmlHead->import(['output' => <<<'HTML'
<head>
    <title>Darling Cms Redesign | Dev Request -> Router <- Response Interactions</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    <style>
 
        * {
           box-sizing: border-box;
           -webkit-box-decoration-break: clone;
           -o-box-decoration-break: clone;
           box-decoration-break: clone;
       }

        html {
           font-size: 15px;
       }

        body {
           font-size: 1em;
       }

        .gradientBg {
           background: rgb(0,0,0);
           background: radial-gradient(circle, rgba(0,0,0,1) 0%, rgba(9,98,121,1) 55%, rgba(6,3,24,1) 100%);
       }

        .genericContainerLimitedHeight {
           height: 13.5em;
           overflow: auto;
       }

        .genericContainer {
           background: #000000;
           padding: 20px;
           border: 2px solid #cddeff;
           border-radius: 7px 1px;
           opacity: 0.77;
           margin-bottom: 20px;
           line-height: 2em;
           resize: vertical;
       }
       
        .genericText {
           color: #ff9368;
       }

        .noticeText {
           color: #ff1858;
       }

        .warningText {
           color: #ffc16f;
       }

        .errorText {
           color: #ff0043;
       }

        .successText {
           color: #63ff99;
       }

        .failureText {
           color: #ff2c2a;
       }

        .formLabelText {
           color: #cddeff;
       }
       
        .highlightText {
           color: #008fff;
       }

        .miniText {
           font-size: .72em;
       }

        .input {
           width: 95%;
           background: #0e1620;
           color: #c8ffc8;
           padding: 7px;
           margin-bottom: 20px;
           border-radius: 7px 1px;
       }

        .textareaInput {
           resize: vertical;
           color: #f57fff;
       }

        .collapsibleButton {
            cursor: pointer;
            padding: 18px;
            width: 100%;
            text-align: left;
            outline: none;
            font-size: 1em;
            user-select: none;
        }

        .collapsibleButton:hover {
            border-radius: 0 0 7px 7px;
            background: #00ffb1;
            box-shadow: 0 3px 7px 0 rgba(220,247,255,0.24), 0 9px 25px 0 rgba(0,255,177,0.33);
        }

        .collapsibleButton:focus {
            background: #00ffb1;
        }
        .active {
            border-radius: 0 !important;
            border-bottom: none;
            margin-bottom: 0;
        }

        .collapsibleContent {
            display: none;
            overflow: hidden;
        }

        .outputComponentInfo {
            border-top: none;
            border-radius: 0 0 7px 7px;
        }

        .textAreaContainer {
            margin-top: 1em;
        }
    
        a {
            text-decoration: none;
        }
    
        a:visited {
            color: #decaff;
        }

        a:active, a:hover {
            background: #008fff;
            border: 1px solid #ffffff;
            border-radius: 10px;
            padding: .1em .5em;
            color: #732b3f;
        }
        table, th, td {
            border-collapse: collapse;
        }
    
        th, td {
            padding: 5px;
        }
        th {
            text-align: left;
        }
    
        textarea {
            height: 287px;
        }
    </style>
</head>
HTML
]);

/**
 * Html <body>
 */
$htmlBody = new OutputComponent(
    new Storable(
        DEMO_SITE_NAME . "WorkingDemoHtmlBody",
        DEMO_SITE_NAME,
        DEMO_SITE_NAME . "HtmlComponents"
    ),
    new Switchable(),
    new Positionable(2)
);

$htmlBody->import(['output' => <<<'HTML'
<body class="gradientBg">
<div id="welcome" class="genericContainer genericContainerLimitedHeight"><h1 class="noticeText">Welcome</h1>
    <p class="successText">
        This is a demonstration the possible relationships/interactions of a<span class="highlightText"> Request</span>,
        <span class="highlightText"> Router</span>, <span class="highlightText"> Response</span>,
        <span class="highlightText"> Crud</span>,<span class="highlightText"> Template</span>, and
        <span class="highlightText"> OutputComponent</span>.
    </p>
    <p class="successText">
        It currently demonstrates how a stored <span class="highlightText"> Response</span> that responds
        to the current <span class="highlightText"> Request</span> can be used to determine what
        <span class="highlightText"> OutputComponent(s)</span>
        is/are used to generate output for the <span class="highlightText"> Request</span>, and which <span
                class="highlightText"> Template(s)</span> is/are used to
        organize that output.
    </p></div>
<div id="formContainer" class="genericContainer genericContainerLimitedHeight">
    <p class="genericText">
        The <a href="#form">form</a> below can be used to generate a <span class="highlightText">Response</span> to a
        <span class="highlightText"> Request</span>. The form allows you to specify the<span class="highlightText"> Request's</span>
        Url, the <span class="highlightText">Request's</span> Name, and the Output that should be
        shown in <span class="highlightText">Response</span> to the <span class="highlightText">Request</span>.<br>
        <span class="noticeText miniText">Note: The form provides default values so if your in a hurry you can
            just click the <span
                    class="highlightText">"Generate Stored Components For Mock Request"</span> button.</span>
    </p>
    <form id="form" class="genericContainer" action="/WorkingDemo.php" method="post">

        <div class="submitButtonContainer">
            <input type="submit" value="Generate Stored Components For Mock Request">
        </div>

        <div class="textInputContainer">
            <label class="formLabelText" for="requestUrl">Request Url:</label>
            <input class="input textInput" type="text" id="requestUrl" name="requestUrl"
                   value="http://192.168.33.10/WorkingDemo.php">
        </div>

        <div class="textInputContainer">
            <label class="formLabelText" for="requestName">Request Name:</label>
            <input class="input textInput" type="text" id="requestName" name="requestName" value="Working Demo">
        </div>

        <div class="selectMenuContainer" style="margin-top: 1em; margin-right:5em; float: right;">
            <span class="formLabelText">Output Position <span class="highlightText">( Relative to other existing output )</span> :</span>
            <select name="position">
                <option>0</option>
                <option>0.01</option>
                <option>0.02</option>
                <option>0.03</option>
                <option>0.04</option>
                <option>0.05</option>
                <option>0.06</option>
                <option>0.07</option>
                <option>0.08</option>
                <option>0.09</option>
                <option>0.1</option>
                <option>0.11</option>
                <option>0.12</option>
                <option>0.13</option>
                <option>0.14</option>
                <option>0.15</option>
                <option>0.16</option>
                <option>0.17</option>
                <option>0.18</option>
                <option>0.19</option>
                <option>0.2</option>
                <option>0.21</option>
                <option>0.22</option>
                <option>0.23</option>
                <option>0.24</option>
                <option>0.25</option>
                <option>0.26</option>
                <option>0.27</option>
                <option>0.28</option>
                <option>0.29</option>
                <option>0.3</option>
                <option>0.31</option>
                <option>0.32</option>
                <option>0.33</option>
                <option>0.34</option>
                <option>0.35</option>
                <option>0.36</option>
                <option>0.37</option>
                <option>0.38</option>
                <option>0.39</option>
                <option>0.4</option>
                <option>0.41</option>
                <option>0.42</option>
                <option>0.43</option>
                <option>0.44</option>
                <option>0.45</option>
                <option>0.46</option>
                <option>0.47</option>
                <option>0.48</option>
                <option>0.49</option>
                <option>0.5</option>
                <option>0.51</option>
                <option>0.52</option>
                <option>0.53</option>
                <option>0.54</option>
                <option>0.55</option>
                <option>0.56</option>
                <option>0.57</option>
                <option>0.58</option>
                <option>0.59</option>
                <option>0.6</option>
                <option>0.61</option>
                <option>0.62</option>
                <option>0.63</option>
                <option>0.64</option>
                <option>0.65</option>
                <option>0.66</option>
                <option>0.67</option>
                <option>0.68</option>
                <option>0.69</option>
                <option>0.7</option>
                <option>0.71</option>
                <option>0.72</option>
                <option>0.73</option>
                <option>0.74</option>
                <option>0.75</option>
                <option>0.76</option>
                <option>0.77</option>
                <option>0.78</option>
                <option>0.79</option>
                <option>0.8</option>
                <option>0.81</option>
                <option>0.82</option>
                <option>0.83</option>
                <option>0.84</option>
                <option>0.85</option>
                <option>0.86</option>
                <option>0.87</option>
                <option>0.88</option>
                <option>0.89</option>
                <option>0.9</option>
                <option>0.91</option>
                <option>0.92</option>
                <option>0.93</option>
                <option>0.94</option>
                <option>0.95</option>
                <option>0.96</option>
                <option>0.97</option>
                <option>0.98</option>
                <option>0.99</option>
                <option>1</option>
                <option>1.01</option>
                <option>1.02</option>
                <option>1.03</option>
                <option>1.04</option>
                <option>1.05</option>
                <option>1.06</option>
                <option>1.07</option>
                <option>1.08</option>
                <option>1.09</option>
                <option>1.1</option>
                <option>1.11</option>
                <option>1.12</option>
                <option>1.13</option>
                <option>1.14</option>
                <option>1.15</option>
                <option>1.16</option>
                <option>1.17</option>
                <option>1.18</option>
                <option>1.19</option>
                <option>1.2</option>
                <option>1.21</option>
                <option>1.22</option>
                <option>1.23</option>
                <option>1.24</option>
                <option>1.25</option>
                <option>1.26</option>
                <option>1.27</option>
                <option>1.28</option>
                <option>1.29</option>
                <option>1.3</option>
                <option>1.31</option>
                <option>1.32</option>
                <option>1.33</option>
                <option>1.34</option>
                <option>1.35</option>
                <option>1.36</option>
                <option>1.37</option>
                <option>1.38</option>
                <option>1.39</option>
                <option>1.4</option>
                <option>1.41</option>
                <option>1.42</option>
                <option>1.43</option>
                <option>1.44</option>
                <option>1.45</option>
                <option>1.46</option>
                <option>1.47</option>
                <option>1.48</option>
                <option>1.49</option>
                <option>1.5</option>
                <option>1.51</option>
                <option>1.52</option>
                <option>1.53</option>
                <option>1.54</option>
                <option>1.55</option>
                <option>1.56</option>
                <option>1.57</option>
                <option>1.58</option>
                <option>1.59</option>
                <option>1.6</option>
                <option>1.61</option>
                <option>1.62</option>
                <option>1.63</option>
                <option>1.64</option>
                <option>1.65</option>
                <option>1.66</option>
                <option>1.67</option>
                <option>1.68</option>
                <option>1.69</option>
                <option>1.7</option>
                <option>1.71</option>
                <option>1.72</option>
                <option>1.73</option>
                <option>1.74</option>
                <option>1.75</option>
                <option>1.76</option>
                <option>1.77</option>
                <option>1.78</option>
                <option>1.79</option>
                <option>1.8</option>
                <option>1.81</option>
                <option>1.82</option>
                <option>1.83</option>
                <option>1.84</option>
                <option>1.85</option>
                <option>1.86</option>
                <option>1.87</option>
                <option>1.88</option>
                <option>1.89</option>
                <option>1.9</option>
                <option>1.91</option>
                <option>1.92</option>
                <option>1.93</option>
                <option>1.94</option>
                <option>1.95</option>
                <option>1.96</option>
                <option>1.97</option>
                <option>1.98</option>
                <option>1.99</option>
                <option>2</option>
                <option>2.01</option>
                <option>2.02</option>
                <option>2.03</option>
                <option>2.04</option>
                <option>2.05</option>
                <option>2.06</option>
                <option>2.07</option>
                <option>2.08</option>
                <option>2.09</option>
                <option>2.1</option>
                <option>2.11</option>
                <option>2.12</option>
                <option>2.13</option>
                <option>2.14</option>
                <option>2.15</option>
                <option>2.16</option>
                <option>2.17</option>
                <option>2.18</option>
                <option>2.19</option>
                <option>2.2</option>
                <option>2.21</option>
                <option>2.22</option>
                <option>2.23</option>
                <option>2.24</option>
                <option>2.25</option>
                <option>2.26</option>
                <option>2.27</option>
                <option>2.28</option>
                <option>2.29</option>
                <option>2.3</option>
                <option>2.31</option>
                <option>2.32</option>
                <option>2.33</option>
                <option>2.34</option>
                <option>2.35</option>
                <option>2.36</option>
                <option>2.37</option>
                <option>2.38</option>
                <option>2.39</option>
                <option>2.4</option>
                <option>2.41</option>
                <option>2.42</option>
                <option>2.43</option>
                <option>2.44</option>
                <option>2.45</option>
                <option>2.46</option>
                <option>2.47</option>
                <option>2.48</option>
                <option>2.49</option>
                <option>2.5</option>
                <option>2.51</option>
                <option>2.52</option>
                <option>2.53</option>
                <option>2.54</option>
                <option>2.55</option>
                <option>2.56</option>
                <option>2.57</option>
                <option>2.58</option>
                <option>2.59</option>
                <option>2.6</option>
                <option>2.61</option>
                <option>2.62</option>
                <option>2.63</option>
                <option>2.64</option>
                <option>2.65</option>
                <option>2.66</option>
                <option>2.67</option>
                <option>2.68</option>
                <option>2.69</option>
                <option>2.7</option>
                <option>2.71</option>
                <option>2.72</option>
                <option>2.73</option>
                <option>2.74</option>
                <option>2.75</option>
                <option>2.76</option>
                <option>2.77</option>
                <option>2.78</option>
                <option>2.79</option>
                <option>2.8</option>
                <option>2.81</option>
                <option>2.82</option>
                <option>2.83</option>
                <option>2.84</option>
                <option>2.85</option>
                <option>2.86</option>
                <option>2.87</option>
                <option>2.88</option>
                <option>2.89</option>
                <option>2.9</option>
                <option>2.91</option>
                <option>2.92</option>
                <option>2.93</option>
                <option>2.94</option>
                <option>2.95</option>
                <option>2.96</option>
                <option>2.97</option>
                <option>2.98</option>
                <option>2.99</option>
                <option>3</option>
                <option>3.01</option>
                <option>3.02</option>
                <option>3.03</option>
                <option>3.04</option>
                <option>3.05</option>
                <option>3.06</option>
                <option>3.07</option>
                <option>3.08</option>
                <option>3.09</option>
                <option>3.1</option>
                <option>3.11</option>
                <option>3.12</option>
                <option>3.13</option>
                <option>3.14</option>
                <option>3.15</option>
                <option>3.16</option>
                <option>3.17</option>
                <option>3.18</option>
                <option>3.19</option>
                <option>3.2</option>
                <option>3.21</option>
                <option>3.22</option>
                <option>3.23</option>
                <option>3.24</option>
                <option>3.25</option>
                <option>3.26</option>
                <option>3.27</option>
                <option>3.28</option>
                <option>3.29</option>
                <option>3.3</option>
                <option>3.31</option>
                <option>3.32</option>
                <option>3.33</option>
                <option>3.34</option>
                <option>3.35</option>
                <option>3.36</option>
                <option>3.37</option>
                <option>3.38</option>
                <option>3.39</option>
                <option>3.4</option>
                <option>3.41</option>
                <option>3.42</option>
                <option>3.43</option>
                <option>3.44</option>
                <option>3.45</option>
                <option>3.46</option>
                <option>3.47</option>
                <option>3.48</option>
                <option>3.49</option>
                <option>3.5</option>
                <option>3.51</option>
                <option>3.52</option>
                <option>3.53</option>
                <option>3.54</option>
                <option>3.55</option>
                <option>3.56</option>
                <option>3.57</option>
                <option>3.58</option>
                <option>3.59</option>
                <option>3.6</option>
                <option>3.61</option>
                <option>3.62</option>
                <option>3.63</option>
                <option>3.64</option>
                <option>3.65</option>
                <option>3.66</option>
                <option>3.67</option>
                <option>3.68</option>
                <option>3.69</option>
                <option>3.7</option>
                <option>3.71</option>
                <option>3.72</option>
                <option>3.73</option>
                <option>3.74</option>
                <option>3.75</option>
                <option>3.76</option>
                <option>3.77</option>
                <option>3.78</option>
                <option>3.79</option>
                <option>3.8</option>
                <option>3.81</option>
                <option>3.82</option>
                <option>3.83</option>
                <option>3.84</option>
                <option>3.85</option>
                <option>3.86</option>
                <option>3.87</option>
                <option>3.88</option>
                <option>3.89</option>
                <option>3.9</option>
                <option>3.91</option>
                <option>3.92</option>
                <option>3.93</option>
                <option>3.94</option>
                <option>3.95</option>
                <option>3.96</option>
                <option>3.97</option>
                <option>3.98</option>
                <option>3.99</option>
                <option>4</option>
                <option>4.01</option>
                <option>4.02</option>
                <option>4.03</option>
                <option>4.04</option>
                <option>4.05</option>
                <option>4.06</option>
                <option>4.07</option>
                <option>4.08</option>
                <option>4.09</option>
                <option>4.1</option>
                <option>4.11</option>
                <option>4.12</option>
                <option>4.13</option>
                <option>4.14</option>
                <option>4.15</option>
                <option>4.16</option>
                <option>4.17</option>
                <option>4.18</option>
                <option>4.19</option>
                <option>4.2</option>
                <option>4.21</option>
                <option>4.22</option>
                <option>4.23</option>
                <option>4.24</option>
                <option>4.25</option>
                <option>4.26</option>
                <option>4.27</option>
                <option>4.28</option>
                <option>4.29</option>
                <option>4.3</option>
                <option>4.31</option>
                <option>4.32</option>
                <option>4.33</option>
                <option>4.34</option>
                <option>4.35</option>
                <option>4.36</option>
                <option>4.37</option>
                <option>4.38</option>
                <option>4.39</option>
                <option>4.4</option>
                <option>4.41</option>
                <option>4.42</option>
                <option>4.43</option>
                <option>4.44</option>
                <option>4.45</option>
                <option>4.46</option>
                <option>4.47</option>
                <option>4.48</option>
                <option>4.49</option>
                <option>4.5</option>
                <option>4.51</option>
                <option>4.52</option>
                <option>4.53</option>
                <option>4.54</option>
                <option>4.55</option>
                <option>4.56</option>
                <option>4.57</option>
                <option>4.58</option>
                <option>4.59</option>
                <option>4.6</option>
                <option>4.61</option>
                <option>4.62</option>
                <option>4.63</option>
                <option>4.64</option>
                <option>4.65</option>
                <option>4.66</option>
                <option>4.67</option>
                <option>4.68</option>
                <option>4.69</option>
                <option>4.7</option>
                <option>4.71</option>
                <option>4.72</option>
                <option>4.73</option>
                <option>4.74</option>
                <option>4.75</option>
                <option>4.76</option>
                <option>4.77</option>
                <option>4.78</option>
                <option>4.79</option>
                <option>4.8</option>
                <option>4.81</option>
                <option>4.82</option>
                <option>4.83</option>
                <option>4.84</option>
                <option>4.85</option>
                <option>4.86</option>
                <option>4.87</option>
                <option>4.88</option>
                <option>4.89</option>
                <option>4.9</option>
                <option>4.91</option>
                <option>4.92</option>
                <option>4.93</option>
                <option>4.94</option>
                <option>4.95</option>
                <option>4.96</option>
                <option>4.97</option>
                <option>4.98</option>
                <option>4.99</option>
                <option>5</option>
            </select>
        </div>

        <div class="textAreaContainer">
            <label class="formLabelText" for="output">Output to show in Response to this Request:</label><br>
            <textarea class="input textareaInput" id="output" name="output"><h2 class="highlightText">Title</h2>
<p class="successText">Quos omnis omnis aut fugit mollitia debitis iusto. Non harum eos eligendi aut aut expedita. Consequatur qui dolorem consequatur incidunt temporibus nam quasi et.</p>
<table class="genericContainer">
  <tr>
    <td class="genericContainer genericText">Generic Text Color</td>
    <td class="genericContainer noticeText">Notice Text Color</td>
    <td class="genericContainer warningText">Warning Text Color</td>
  </tr>
  <tr>
    <td class="genericContainer errorText">Error Text Color</td>
    <td class="genericContainer successText">Success Text Color</td>
    <td class="genericContainer failureText">Failure Text Color</td>
  </tr>
  <tr>
    <td class="genericContainer formLabelText">Form Label Text Color</td>
    <td class="genericContainer highlightText">Highlight Text Color</td>
    <td class="genericContainer genericText miniText">Mini Text Size</td>
  </tr>
</table></textarea>
        </div>

        <div style="clear: both"></div>

        <input type="hidden" name="requestLocation" value="Demo">
        <input type="hidden" name="requestContainer" value="Request">

        <div class="submitButtonContainer">
            <input type="submit" value="Generate Stored Components For Mock Request">
        </div>
    </form>
</div>
<div id="requestMenu" class="genericContainer genericContainerLimitedHeight">
    <h3 class='highlightText'>Current Request Info</h3>
    <p class='genericText'>Name: <span class='highlightText'>Current Request WNuL6lOCq1xF</span></p>
    <p class='genericText'>Url: <a href='http://192.168.33.10/WorkingDemo.php' class='highlightText'>http://192.168.33.10/WorkingDemo.php</a>
    </p>
    <p class='genericText'>Unique Id:<span class='highlightText'>eEsQvafpEeR5WJfwUudTRwjia4pk3kFz2OjoTFpCrb3FvqGx1Q63FL4WdGMJjc2f6QXrjytmSFvV2LexelAFJo5PinfCOovsuEmtnzQGIdVfsLtuApCVORJmzPdvUxu2</span>
    </p>
</div>


<script>
    let coll = document.getElementsByClassName("collapsibleButton");
    let i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function () {
            this.classList.toggle("active");
            let content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }
</script>

</body>
HTML
]);

$finalOutput = new OutputComponent(
    new Storable(
        DEMO_SITE_NAME . "WorkingDemoHtmlFinalOutput",
        DEMO_SITE_NAME,
        DEMO_SITE_NAME . "HtmlComponents"
    ),
    new Switchable(),
    new Positionable(3)
);
$finalOutput->import(['output' => '</html><!-- this html was generated by Darling Data Management System Components configured by the WorkingDemo App -->']);


printf("%s%s%s%s", $doctype->getOutput(), $htmlHead->getOutput(), $htmlBody->getOutput(), $finalOutput->getOutput());

