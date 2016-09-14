<!DOCTYPE html>
<html>
    <head>
        <title>Test kisliymaxim</title>

        <link rel="stylesheet" href="{{ URL::asset('css/site.css')}}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://unpkg.com/react@15.3.1/dist/react.js"></script>
        <script src="https://unpkg.com/react-dom@15.3.1/dist/react-dom.js"></script>
        <script src="https://unpkg.com/babel-core@5.8.38/browser.min.js"></script>

    </head>
    <body>
        <div class="container">
            <div class="title">Please select a date</div>
            <div class="content" id="dayselector"></div>
            <div class="content"  id="monthselector"></div>
            <div class="content"  id="yearselector"></div>
            <div class="content"  id="resetbutton"></div>
            <div class="content"  id="savebutton"></div>
            <div id="chart"></div>
            <script type="text/javascript">
                var eur_obj = new Object(), usd_obj = new Object(), rub_obj = new Object(), reset=false;
                var now = new Date(), dd = now.getDate(), mm = now.getMonth()+1, yyyy = now.getFullYear();
                if(dd<10) {
                    dd='0'+dd
                }
                if(mm<10) {
                    mm='0'+mm
                }
                now = yyyy+'-'+mm+'-'+dd;
                google.charts.load('current', {'packages':['bar','corechart']});
                google.charts.setOnLoadCallback(drawChart);
                $.getJSON('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5', function(data) {
                    $.each(data, function(key, val) {
                        if(val.ccy == 'EUR') {
                            eur_obj.date = now;
                            eur_obj.buy = val.buy;
                            eur_obj.sell = val.sale;
                        }
                        else if(val.ccy == 'USD') {
                            usd_obj.date = now;
                            usd_obj.buy = val.buy;
                            usd_obj.sell = val.sale;
                        }
                        else if(val.ccy == 'RUR') {
                            rub_obj.date = now;
                            rub_obj.buy = val.buy;
                            rub_obj.sell = val.sale;
                        }
                    });
                });
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Type', 'USD', 'RUB', 'EUR'],
                        ["Buy", usd_obj.buy, rub_obj.buy, eur_obj.buy],
                        ["Sale", usd_obj.sell, rub_obj.sell, eur_obj.sell]
                    ]);

                    if(reset==false)
                        var show_date=now;
                    else
                        var show_date=usd_obj.date;

                    var options = {
                        chart: {
                            title: 'Currency rate ' + show_date,
                            subtitle: 'The rate of purchase and sale'
                        },
                        bars: 'vertical',
                        hAxis: {format: 'no format'}
                    };
                    var chart = new google.charts.Bar(document.getElementById('chart'));
                    chart.draw(data, options);
                }
            </script>
            <script type="text/babel">
                var day='01',month='01',year='2009';
                var DaySelector = React.createClass({
                    getInitialState:function(){
                        return {selectValue:'01'};
                    },
                    handleChange:function(e){
                        this.setState({selectValue:e.target.value});
                        var tmp={selectValue:e.target.value};
                        day=tmp.selectValue;
                        getRate();
                    },
                    render: function() {
//                        var rows = [];
//                        for (var i=1; i < 32; i++) {
//                            rows.push("<option value='0"+i+"'>0"+i+"</option>");
//                        }
                        return (
                                <div>Day
                                    <select value={this.state.selectValue}
                                            onChange={this.handleChange}
                                    >
                                        <option value='01'>01</option>
                                        <option value='02'>02</option>
                                        <option value='03'>03</option>
                                        <option value='04'>04</option>
                                        <option value='05'>05</option>
                                        <option value='06'>06</option>
                                        <option value='07'>07</option>
                                        <option value='08'>08</option>
                                        <option value='09'>09</option>
                                        <option value='10'>10</option>
                                        <option value='11'>11</option>
                                        <option value='12'>12</option>
                                        <option value='13'>13</option>
                                        <option value='14'>14</option>
                                        <option value='15'>15</option>
                                        <option value='16'>16</option>
                                        <option value='17'>17</option>
                                        <option value='18'>18</option>
                                        <option value='19'>19</option>
                                        <option value='20'>20</option>
                                        <option value='21'>21</option>
                                        <option value='22'>22</option>
                                        <option value='23'>23</option>
                                        <option value='24'>24</option>
                                        <option value='25'>25</option>
                                        <option value='26'>26</option>
                                        <option value='27'>27</option>
                                        <option value='28'>28</option>
                                        <option value='29'>29</option>
                                        <option value='30'>30</option>
                                        <option value='31'>31</option>
                                    </select>
                                </div>
                        );
                    }
                });
                var MonthSelector = React.createClass({
                    getInitialState:function(){
                        return {selectValue:'01'};
                    },
                    handleChange:function(e){
                        this.setState({selectValue:e.target.value});
                        var tmp={selectValue:e.target.value};
                        month=tmp.selectValue;
                        getRate();
                    },
                    render: function() {
                        return (
                                <div> Month
                                    <select value={this.state.selectValue}
                                            onChange={this.handleChange}
                                    >
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                        );
                    }
                });
                var YearSelector = React.createClass({
                    getInitialState:function(){
                        return {selectValue:'2009'};
                    },
                    handleChange:function(e){
                        this.setState({selectValue:e.target.value});
                        var tmp={selectValue:e.target.value};
                        year=tmp.selectValue;
                        getRate();
                    },
                    render: function() {
                        return (
                                <div> Year
                                    <select value={this.state.selectValue}
                                            onChange={this.handleChange}
                                    >
                                        <option value="2009">2009</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                    </select>
                                </div>
                        );
                    }
                });
                var ResetButton = React.createClass({
                    handleChange:function(e){
                        reset=false;
                        $("#overlay").fadeIn(300);
                        $("#loader").fadeIn(300);
                        $.getJSON('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5', function(data) {
                            $("#overlay").fadeOut(300);
                            $("#loader").fadeOut(300);
                            $.each(data, function(key, val) {
                                if(val.ccy == 'EUR') {
                                    eur_obj.date = now;
                                    eur_obj.buy = val.buy;
                                    eur_obj.sell = val.sale;
                                }
                                else if(val.ccy == 'USD') {
                                    usd_obj.date = now;
                                    usd_obj.buy = val.buy;
                                    usd_obj.sell = val.sale;
                                }
                                else if(val.ccy == 'RUR') {
                                    rub_obj.date = now;
                                    rub_obj.buy = val.buy;
                                    rub_obj.sell = val.sale;
                                }
                            });
                        });
                        drawChart();
                    },
                    render: function() {
                        return (
                                <button onClick={this.handleChange}>Reset</button>
                        );
                    }
                });
                var SaveButton = React.createClass({
                    handleChange:function(e){
                        $.ajax({
                            url: '{{ url('/') }}/add',
                            type: 'get',
                            data: 'usd_buy='+usd_obj.buy+'&usd_sell='+usd_obj.sell+'&eur_buy='+eur_obj.buy+'&eur_sell='+eur_obj.sell+'&rub_buy='+rub_obj.buy+'&rub_sell='+rub_obj.sell+'&date='+rub_obj.date,
                            beforeSend: function(){
                                $("#overlay").fadeIn(300);
                                $("#loader").fadeIn(300);
                            },
                            success: function(data){
                                $("#overlay").fadeOut(300);
                                $("#loader").fadeOut(300);
                                if(data == 1)
                                    alert('Запись успешно добавлена в БД');
                                else
                                    alert('Что-то пошло не так');
                            }
                        });
                    },
                    render: function() {
                        return (
                                <button onClick={this.handleChange}>Save</button>
                        );
                    }
                });
                ReactDOM.render(<MonthSelector />, document.getElementById('monthselector'));
                ReactDOM.render(<DaySelector />, document.getElementById('dayselector'));
                ReactDOM.render(<YearSelector />, document.getElementById('yearselector'));
                ReactDOM.render(<ResetButton />, document.getElementById('resetbutton'));
                ReactDOM.render(<SaveButton />, document.getElementById('savebutton'));

                function getRate(){
                    reset=true;
                    $.ajax({
                        url: '{{ url('/') }}/getrate',
                        dataType: 'json',
                        type: 'get',
                        data: 'day='+day+'&month='+month+'&year='+year,
                        beforeSend: function(){
                            $("#overlay").fadeIn(300);
                            $("#loader").fadeIn(300);
                        },
                        success: function(data){
                            $("#overlay").fadeOut(300);
                            $("#loader").fadeOut(300);
                            eur_obj.date = data.date;
                            eur_obj.buy = data.eur_buy;
                            eur_obj.sell = data.eur_sell;
                            usd_obj.date = data.date;
                            usd_obj.buy = data.usd_buy;
                            usd_obj.sell = data.usd_sell
                            rub_obj.date = data.date;
                            rub_obj.buy = data.rub_buy;
                            rub_obj.sell = data.rub_sell;
                            drawChart();
                        }
                    });
                }
            </script>
        </div>
        <div id="overlay"></div>
        <div id="loader" class="loader-container ball-chasing">
            <div class="loader">
                <div class="ball-1"></div>
                <div class="ball-2"></div>
            </div>
        </div>
    </body>
</html>
