#The purpose of this script is to document what patches were applied
#to the recovery project. It assumes that you have initialized the
#android source using repoinit.sh

cd mydroid/recovery

git fetch git://android.git.kernel.org/platform/recovery.git changes/02/2902/1

#http://review.source.android.com/2902
git cherry-pick 7b5a935100d1560ad58d8afee346b4644b1671e0

patch -p1 < ../../recovery/recovery.diff