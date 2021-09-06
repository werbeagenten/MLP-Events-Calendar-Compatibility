# Description

The Multilingual Press Plugin comes with a "Duplicate Content" function which creates a duplicate of the current post to another language.

When using this duplicate function with the events from the "The Events Calendar" Plugin, the duplicated Events returns a 404 not found page in the frontend.

This is because the events postmeta fields were not duplicated by the Duplicate Content Funciton. And because some of the postmeta fields are required (Start and End Date) the Event displays an 404 error.

This Plugins add those required postmeta fields to the Duplicate Content Process which fixes the 404 error.

