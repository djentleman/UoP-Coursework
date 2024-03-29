/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package vysichart;

/**
 *
 * @author U AMD
 */
import javax.swing.JFrame;
import java.awt.Graphics;
import javax.swing.JPanel;
import java.awt.Color;
import javax.swing.JLabel;
import javax.swing.ImageIcon;
import java.awt.BorderLayout;
import java.util.*; //for arraylists

public class GanttRender extends JPanel {

    private Chart gantt; // the gantt to render

    public GanttRender(Chart gantt) // set up graphics window
    {
        super();
        //setBackground(Color.WHITE);
        this.gantt = gantt;
    }
    
    @Override
    public void paintComponent(Graphics g) // draw graphics in the panel
    {
        int width = getWidth();             // width of window in pixels
        int height = getHeight();           // height of window in pixels



        super.paintComponent(g);

        initAxis(g);
        int yCoord;
        //for(Task t : Gantt.getTasks())
            //Calculate percentage
            /* Calculate task start percentage by:
             * find task start time (t.getStartDate())
             * find project start time (first parent task start time)
             * find project end time (last child task end time)
             */
            //drawNode(g, xCoord, yCoord, taskWidth);
            //yCoord += 30;

    }

    public void initAxis(Graphics g) {
        g.drawLine(10, 30, 790, 30); // x axis
        g.drawString("x", 800, 30);
        g.drawLine(10, 30, 10, 440); // y axis
        g.drawString("y", 10, 450);
    }

    public void drawNode(Graphics g, int x, int y, int width, String taskName) {
        // draw an individual node
        // box height = 20
        // test boxWidth = 120
        g.drawRect(x, y, width, 30);
        g.drawString(taskName, x + 10, y + 17);


    }

    public void drawChart(Graphics g) {
        //TODO
    }
    
    public void sortTasks(){
        //TODO
    }

    public void run() { // for debug
        GanttRender panel = new GanttRender(gantt);                            // window for drawing
        JFrame application = new JFrame();                            // the program itself

        application.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);   // set frame to exit
        // when it is closed
        application.add(panel);


        application.setSize(800, 450);         // window is 800 pixels wide, 450 high (size of panel in GUI)
        application.setVisible(true);

    }
}
