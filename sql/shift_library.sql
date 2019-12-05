use clef;

-- Showing all of the scheduled shift duties for every user. This can be flipped to all unscheduled 
-- shift duties by changing the where clause to where (scheduled=0);
select clef_user.userid, clef_user.firstName, clef_user.lastName, shift.shiftDay, shift.beginTime, shift.endTime, courseID
from shift_duty 
	inner join shift on (shift_duty.shiftID = shift.shiftID) 
    inner join clef_user on (shift_duty.userID = clef_user.userID)
where (scheduled=1);

-- Showing all scheduled and unscehduled shift duties for any given user ref by clef_user.userID
select clef_user.firstName, clef_user.lastName, shift.shiftDay, shift.beginTime, shift.endTime, courseID, scheduled 
from shift_duty 
	inner join shift on (shift_duty.shiftID = shift.shiftID) 
    inner join clef_user on (shift_duty.userID = clef_user.userID)
where (clef_user.userID=4);


