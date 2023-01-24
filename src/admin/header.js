/* global appLocalizer */
import React, { Component } from 'react';
class Header extends Component {

	// sliderjs start-------

	componentDidMount() {
        var $ = jQuery;
        var cs = 1;

// to show default banner at first -------
		$("#txt0").show();
		$(".mvx-pro-txt:not(#txt0)").hide();
			

		$(document).ready(function(){

			$(".mvx-pro-txt").each(function(e){
				if (e != 0)
				 $(this).hide();
			});

		// preview button click function ------
			$(".p-prev").click(function(){	
				if(cs > 1){
				cs--;

				if ($(".mvx-logo-top .mvx-pro-txt:visible").prev().length != 0){
					$(".mvx-logo-top .mvx-pro-txt:visible").prev().show().next().hide();					
					$('.message-banner-sliding span').html( cs + ' of 4');
				}
					
				else {
					$(".mvx-logo-top .mvx-pro-txt:visible").hide();
					$(".mvx-logo-top .mvx-pro-txt:first").show();			
				}
			}
				return false;		
			});

		// next button click function ------
			$(".p-next").click(function(){				
				if(cs < 4){
					cs++;

				if ($(".mvx-logo-top .mvx-pro-txt:visible").next().length != 0){
					$(".mvx-logo-top .mvx-pro-txt:visible").next().show().prev().hide();
				
					$('.message-banner-sliding span').html( cs + ' of 4');
					}

				else {
					$(".mvx-logo-top .mvx-pro-txt:visible").hide();
					$(".mvx-logo-top .mvx-pro-txt:first").show();
				}
			}
				return false;		
			});

		  });

		  //slider js end here------

	}

	render() {
		return (
			<div className="mvx-sidebar">
				<div className='mvx-banner-top'>
					<div className='mvx-logo-top'>
						<div class="mvx-pro-txt" id="txt0">
						<div class="mvx-dashboard-top-icon"><span>Pro</span></div>
						<div className='mvx-pro-txt-items'>
							<h3>Top Banner1</h3>
							<p>To unlock advanced catalog features, try WooCommerce Quote and Product Enquiry. Go Pro!  </p>
							<a href='#' className="mvx-btn btn-red">
                                   Upgrade to pro
                            </a>
						</div>
						</div>
						<div class="mvx-pro-txt" id="txt1">
						<div class="mvx-dashboard-top-icon"><span>Pro</span></div>
						<div className='mvx-pro-txt-items'>
							<h3>Top Banner2</h3>
							<p>Create a fully customizable product inquiry form by using a variety of options. Go Pro! </p>
							<a href='#' className="mvx-btn btn-red">
                                   Upgrade to pro
                            </a>
						</div>
						</div>
						<div class="mvx-pro-txt" id="txt2">
						<div class="mvx-dashboard-top-icon"><span>Pro</span></div>
						<div className='mvx-pro-txt-items'>
							<h3>Top 3</h3>
							<p>Erase the difficulty of choice by adding multiple enquiries to your enquiry cart. </p>
							<a href='#' className="mvx-btn btn-red">
                                   Upgrade to pro
                            </a>
						</div>
						</div>
						<div class="mvx-pro-txt" id="txt3">
						<div class="mvx-dashboard-top-icon"><span>Pro</span></div>
						<div className='mvx-pro-txt-items'>
							<h3>Top</h3>
							<p>Enable both catalog and checkout mode together. </p>
							<a href='#' className="mvx-btn btn-red">
                                   Upgrade to pro
                            </a>
						</div>
						</div>

						

					</div>
					<div className="message-banner-sliding">
                                <a href="#" className="p-prev">
                                    <i className="mvx-catalog icon-general-tab" />
                                </a> &nbsp;
                              <span>1 of 4</span> &nbsp;
                                <a href="#" className="p-next">
								  <i className="mvx-catalog icon-button-appearance-tab" />
                                </a>
                            </div>
				</div>
			</div>

	


		);
	}
}
export default Header;
