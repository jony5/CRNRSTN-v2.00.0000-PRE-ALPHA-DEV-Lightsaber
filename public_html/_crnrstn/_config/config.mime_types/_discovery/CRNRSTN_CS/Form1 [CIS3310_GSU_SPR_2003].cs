using System;
using System.Drawing;
using System.Collections;
using System.ComponentModel;
using System.Windows.Forms;
using System.Data;

namespace WindowsApplication1
{
	/// <summary>
	/// Summary description for Form1.
	/// </summary>
	public class Form1 : System.Windows.Forms.Form
	{
		private System.Windows.Forms.Button btCompute;
		private System.Windows.Forms.Button btQuit;
		private System.Windows.Forms.RadioButton opFahr;
		private System.Windows.Forms.RadioButton opCels;
		private System.Windows.Forms.TextBox txEntry;
		private System.Windows.Forms.Label lbResult;
		/// <summary>
		/// Required designer variable.
		/// </summary>
		private System.ComponentModel.Container components = null;

		public Form1()
		{
			//
			// Required for Windows Form Designer support
			//
			InitializeComponent();

			//
			// TODO: Add any constructor code after InitializeComponent call
			//
		}

		/// <summary>
		/// Clean up any resources being used.
		/// </summary>
		protected override void Dispose( bool disposing )
		{
			if( disposing )
			{
				if (components != null) 
				{
					components.Dispose();
				}
			}
			base.Dispose( disposing );
		}

		#region Windows Form Designer generated code
		/// <summary>
		/// Required method for Designer support - do not modify
		/// the contents of this method with the code editor.
		/// </summary>
		private void InitializeComponent()
		{
			this.btCompute = new System.Windows.Forms.Button();
			this.btQuit = new System.Windows.Forms.Button();
			this.opFahr = new System.Windows.Forms.RadioButton();
			this.opCels = new System.Windows.Forms.RadioButton();
			this.txEntry = new System.Windows.Forms.TextBox();
			this.lbResult = new System.Windows.Forms.Label();
			this.SuspendLayout();
			// 
			// btCompute
			// 
			this.btCompute.Location = new System.Drawing.Point(72, 144);
			this.btCompute.Name = "btCompute";
			this.btCompute.Size = new System.Drawing.Size(64, 24);
			this.btCompute.TabIndex = 0;
			this.btCompute.Text = "Compute";
			this.btCompute.Click += new System.EventHandler(this.btCompute_Click);
			// 
			// btQuit
			// 
			this.btQuit.Location = new System.Drawing.Point(176, 144);
			this.btQuit.Name = "btQuit";
			this.btQuit.Size = new System.Drawing.Size(64, 24);
			this.btQuit.TabIndex = 1;
			this.btQuit.Text = "Quit";
			this.btQuit.Click += new System.EventHandler(this.btQuit_Click);
			// 
			// opFahr
			// 
			this.opFahr.Location = new System.Drawing.Point(112, 64);
			this.opFahr.Name = "opFahr";
			this.opFahr.Size = new System.Drawing.Size(104, 16);
			this.opFahr.TabIndex = 2;
			this.opFahr.Text = "Fahrenheit";
			// 
			// opCels
			// 
			this.opCels.Location = new System.Drawing.Point(112, 96);
			this.opCels.Name = "opCels";
			this.opCels.Size = new System.Drawing.Size(64, 16);
			this.opCels.TabIndex = 3;
			this.opCels.Text = "Celsius";
			// 
			// txEntry
			// 
			this.txEntry.Location = new System.Drawing.Point(72, 8);
			this.txEntry.Name = "txEntry";
			this.txEntry.Size = new System.Drawing.Size(128, 20);
			this.txEntry.TabIndex = 4;
			this.txEntry.Text = "0";
			// 
			// lbResult
			// 
			this.lbResult.Location = new System.Drawing.Point(72, 40);
			this.lbResult.Name = "lbResult";
			this.lbResult.Size = new System.Drawing.Size(128, 16);
			this.lbResult.TabIndex = 5;
			// 
			// Form1
			// 
			this.AutoScaleBaseSize = new System.Drawing.Size(5, 13);
			this.ClientSize = new System.Drawing.Size(280, 245);
			this.Controls.AddRange(new System.Windows.Forms.Control[] {
																		  this.lbResult,
																		  this.txEntry,
																		  this.opCels,
																		  this.opFahr,
																		  this.btQuit,
																		  this.btCompute});
			this.Name = "Form1";
			this.Text = "Form1";
			this.ResumeLayout(false);

		}
		#endregion

		/// <summary>
		/// The main entry point for the application.
		/// </summary>
		[STAThread]
		static void Main() 
		{
			Application.Run(new Form1());
		}

		private void btCompute_Click(object sender, System.EventArgs e)
		{
			float temp, newtemp;
			temp = Convert.ToSingle (txEntry.Text);
			if (opFahr.Checked  ) {
				newtemp = (9*temp/5)+32;
			}
			else 			{
				newtemp = 5*(temp - 32)/9;
			}
			lbResult.Text =newtemp.ToString() ;		}

		private void btQuit_Click(object sender, System.EventArgs e) {
			this.Dispose ();
		}
	}
}
