(async function () {

  // Fetch the external data
  let response = await fetch("https://my-parkrun-data-ffguczbcbhdvgvge.uksouth-01.azurewebsites.net/api/parkruns");
  let myParkrunData = await response.json();

  // Gather possible dates
  const FIRST_SATURDAY = new Date(2026, 8, 5);
  const LAST_SATURDAY = new Date(2027, 8, 4);
  const CHRISTMAS_DAY = new Date(2026, 11, 25);
  const NEW_YEARS_DAY = new Date(2027, 0, 1);

  let possibleParkrunDates = new Array(
    CHRISTMAS_DAY, 
    NEW_YEARS_DAY,
    ...getSaturdaysBetween(FIRST_SATURDAY, LAST_SATURDAY)
  );

  possibleParkrunDates.sort((a, b) => a - b);

  // Render the tracker table
  renderTrackerTable(possibleParkrunDates, myParkrunData);

  
  // Works out normal Parkrun Saturdays
  function getSaturdaysBetween(startDate, endDate) {
  
    let saturdays = new Array();
  
    let d = startDate;

    while(d <= endDate) {
      saturdays.push(new Date(d));
      d.setDate(d.getDate()+7);
    }
  
    return saturdays;

  }

  // Renders the tracker table
  function renderTrackerTable(possibleParkrunDates, myParkrunData) {

    let trackerTable = document.createElement("ol");

    possibleParkrunDates.forEach((date) => {
      let el = document.createElement("li");
      let tt = document.createElement("span");

      tt.classList.add('tooltip');
      tt.innerText = date.toDateString();

      // Checks to see if this date exists within the completed parkrun dates array
      let match = myParkrunData.parkruns.find((parkrun) => {
        return date.getTime() === new Date(parkrun.run_date).getTime();
      });

      if(match) el.classList.add('run');

      // If NOW is greater than 23:59:59 on the day of the possible parkrun, the run 
      // has definitely been missed
      const NOW = new Date().getTime();
      const RUN_DATE_END_OF_DAY = new Date(date.setHours(23,59,59)).getTime();
      if(!match && (NOW > RUN_DATE_END_OF_DAY)) el.classList.add('norun');   

      el.append(tt);
      trackerTable.append(el);
    });
    
    document.getElementById('parkrunTracker').append(trackerTable);
  }
  
})();