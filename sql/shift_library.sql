use clef;


-- Showing all of the shift duties for every user
select clef_user.firstName, clef_user.lastName, shift.shiftDay, shift.beginTime, shift.endTime, courseID 
from shift_duty 
	inner join shift on (shift_duty.shiftID = shift.shiftID) 
    inner join clef_user on (shift_duty.userID = clef_user.userID)
where (scheduled=1);