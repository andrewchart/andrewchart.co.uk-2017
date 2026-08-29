(function () {

  const FIRST_SATURDAY = new Date(2026, 8, 5);
  const LAST_SATURDAY = new Date(2027, 8, 4);
  const CHRISTMAS_DAY = new Date(2026, 11, 25);
  const NEW_YEARS_DAY = new Date(2027, 0, 1);

  // Gather possible dates
  let possibleParkrunDates = new Array(
    CHRISTMAS_DAY, 
    NEW_YEARS_DAY,
    ...getSaturdaysBetween(FIRST_SATURDAY, LAST_SATURDAY)
  );

  possibleParkrunDates.sort((a, b) => a - b);


  let trackerTable = document.createElement("ol");

  possibleParkrunDates.forEach((date) => {
    let el = document.createElement("li");
    let tt = document.createElement("span");

    tt.classList.add('tooltip');
    tt.innerText = date.toDateString();

    el.append(tt);
    trackerTable.append(el);
  });
  
  document.getElementById('parkrunTracker').append(trackerTable);
  
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
  
})();