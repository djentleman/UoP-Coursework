/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package boxodering;

/**
 *
 * @author U AMD
 */
public class BoxII extends Box {

    protected String col1;

    public BoxII() {
    } //default constructor

    public BoxII(int grade, double height, double width, double depth, boolean isSealable, String col1) {
        super(grade, height, width, depth, isSealable);
        this.col1 = col1;
        id = 2;
    }



    public void setCol1(String col) {
        col1 = col;
    }

    public String getCol1() {
        return col1;
    }

    @Override
    protected double getMultiplier(double currentMultiplier) {
        // this method will only be used in subclass calls
        double multiplier = super.getMultiplier(currentMultiplier); //nothing is added, because this will be called from a 2 col box
        return multiplier;
    }
    
    public double getMultiplier(){
        //method is called from external processes, so public
        double multiplier = super.getMultiplier(12);
        multiplier = 1 + (multiplier / 100); //changes to percent form
        return multiplier;
    }
}
