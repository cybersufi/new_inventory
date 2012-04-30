/*!
 * Inventory Library 0.1
 * Copyright(c) 2010.
 * 
 *=========================================================
 * Description of logout
 *
 * @author bkrisna
 *=========================================================
 *
 */
 
Ext.onReady(function() {
	setTimeout(function(){
		if (self == top) {
			window.location = site_url;
		} else {
			parent.location = site_url;
		}
	}, 350);
});