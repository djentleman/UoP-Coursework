/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package boxodering;

/**
 *
 * @author U AMD
 */
public class BoxIV extends BoxIII {

    public BoxIV() {
    } //default constructor

    public BoxIV(int grade, double height, double width, double depth,
            boolean isSealable, String col1, String col2) {
        super(grade, height, width, depth, isSealable, col1, col2);
        id = 4;
    }


    
    public double getMultiplier() {
        //method is called from external processes, so public
        double multiplier = super.getMultiplier(10); //10% for reinforced sides
        multiplier = 1 + (multiplier / 100); //changes to percent form
        return multiplier;
    }
}
